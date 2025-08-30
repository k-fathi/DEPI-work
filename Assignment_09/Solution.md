# Assignment_09: Install Docker with Ansible & Deploy PetClinic

This document describes how I experimented with and implemented three different ways to install Docker on managed nodes using Ansible, and how I used those nodes to run the Spring PetClinic application. It includes small, copy-pasteable playbook examples, inventory snippets, and the commands I used to test the deployments.

## Outline

- Purpose & goals
- Prerequisites
- Quick summary of the three approaches
- Detailed steps and embedded examples:
    - install from apt repository (package manager)
    - install from Docker convenience script
    - install using a role (`geerlingguy.docker`) + small `admin-setup` role
- How to run the PetClinic examples (`docker-petclinic` and `full-petclinic`)
- Verification and troubleshooting tips
- Files changed / where to look

## Purpose & goals

Goal: demonstrate multiple, idempotent ways to install Docker on remote hosts with Ansible, show how to run the PetClinic app on those hosts, and provide ready-to-use snippets so you can reproduce the results quickly.

## Prerequisites

- Control machine: Linux (Bash shell) with Ansible installed.
- SSH access to managed nodes (private key present and referenced in inventory or `ansible.cfg`).
- The repository layout used in this assignment (see project folders: `ways-to-install-docker` and `working-area`).

## Quick summary of the three approaches

1. install-docker-from-apt — simple apt-based installation (good for controlled environments; explicit package pins possible).
2. install-docker-from-script — use Docker's official convenience script (fast, gets latest Docker; less control than distro packages).
3. install-docker-from-role — use the community `geerlingguy.docker` role (recommended for production-like, idempotent deployments).


## check out: [Docker docs](https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository)



## 1) Install from apt (example)

This approach installs Docker packages using the distribution package manager. The project folder `ways-to-install-docker/install-docker-from-apt` contains a `playbook.yaml` like the following minimal example:

```yaml
---
- name: Setup User and Install Docker
  hosts: aws
  become: yes

  tasks:
    - name: 1. Add 'admin' user
      ansible.builtin.user:
        name: admin
        state: present
        create_home: yes
        shell: /bin/bash

    - name: 2. Make 'admin' user a passwordless sudoer
      ansible.builtin.lineinfile:
        path: /etc/sudoers.d/admin
        line: 'admin ALL=(ALL) NOPASSWD: ALL'
        owner: root
        group: root
        mode: '0440'
        create: yes
        validate: 'visudo -cf %s'

    - name: 3. Install prerequisites for Docker repository
      ansible.builtin.apt:
        name:
          - ca-certificates
          - curl
        state: present
        update_cache: yes

    - name: 4. Create Docker's GPG key directory
      ansible.builtin.file:
        path: /etc/apt/keyrings
        mode: '0755'
        state: directory

    - name: 5. Add Docker's official GPG key
      ansible.builtin.get_url:
        url: https://download.docker.com/linux/ubuntu/gpg
        dest: /etc/apt/keyrings/docker.asc
        mode: '0644'

    - name: 6. Add the Docker APT repository (with fix for new OS versions)
      apt_repository:
        repo: "deb [arch=amd64 signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu jammy stable"
        state: present
        filename: docker

    - name: 7. forcce update the packages
      ansible.builtin.apt:
        update_cache: yes
    
    - name: 8. Install Docker Engine and related packages
      ansible.builtin.apt:
        name:
          - docker-ce
          - docker-ce-cli
          - containerd.io
          - docker-buildx-plugin
          - docker-compose-plugin
        state: present
        update_cache: yes

    - name: 9. Add 'admin' user to the 'docker' group
      ansible.builtin.user:
        name: admin
        groups: docker
        append: yes

    - name: 10. Start and enable the Docker service
      ansible.builtin.service:
        name: docker
        state: started
        enabled: yes
```

Project files (local to this example):

- Playbook: [playpbook.yaml](ways-to-install-docker/install-docker-from-apt/playbook.yaml)
- Inventory: [inventory.ini](ways-to-install-docker/install-docker-from-apt/inventory.ini)
- Local config: [ansible.cfg](ways-to-install-docker/install-docker-from-apt/ansible.cfg)


Run it from the `install-docker-from-apt` directory:

```bash
ansible-playbook  playbook.yaml 
```


## 2) Install from Docker convenience script (example)

This method downloads and executes Docker's official install script. The `install-docker-from-script/playbook.yaml` contains a task similar to:

```yaml
- name: Install Docker using the convenience script
    hosts: all
    become: true
    tasks:
        - name: Download get.docker.com
            get_url:
                url: https://get.docker.com/
                dest: /tmp/get-docker.sh
                mode: '0755'

        - name: Run Docker install script
            command: /tmp/get-docker.sh

        - name: Ensure docker is started
            service:
                name: docker
                state: started
                enabled: true
```


Project files (local to this example):

- Playbook: [playpbook.yaml](ways-to-install-docker/install-docker-from-script/playbook.yaml)
- Inventory: [inventory.ini](ways-to-install-docker/install-docker-from-script/inventory.ini)
- Local config: [ansible.cfg](ways-to-install-docker/install-docker-from-script/ansible.cfg)

Run it the same way:

```bash
ansible-playbook  playbook.yaml
```

Notes:
- This gives you the convenience of the latest Docker packages maintained by Docker. It's fast, but less controlled than installing via distro packages.

Project files (local to this example):


## 3) Install using Ansible role (`geerlingguy.docker`) + admin setup

This is the approach used in `install-docker-from-role` and is my recommended option for real projects. It uses a small `admin-setup` role (for user and sudo setup) and the community `geerlingguy.docker` role to manage Docker installation and configuration across distributions.

fisrt you have to install the geerlingguy.docker role on your control node:

```bash
ansible-galaxy install geerlingguy.docker
```
include this role to the `playbook.yaml` file

Example `playbook.yaml` that includes both roles:

```yaml
---
- name: isntall docker from ansible role
  hosts: aws
  roles:
    - admin-setup
    - geerlingguy.docker
```

Key benefits:
- `geerlingguy.docker` is idempotent and supports multiple distros.
- Roles split responsibilities: `admin-setup` for user creation and `geerlingguy.docker` for Docker config.

Project files (local to this example):

- Playbook: [playbook.yaml](ways-to-install-docker/install-docker-from-role/playbook.yaml)
- Inventory: [inventory.ini](ways-to-install-docker/install-docker-from-role/inventory.ini)
- Local config: [ansible.cfg](ways-to-install-docker/install-docker-from-role/ansible.cfg)

Run it like the others:

```bash
ansible-playbook playbook.yaml
```

## Inventory and `ansible.cfg` examples

A minimal `inventory.ini` entry used in these experiments:

```ini
[servers]
petclinic-node ansible_host=<192.0.2.10> ansible_user=ubuntu ansible_ssh_private_key_file=./docker-petclinic.pem
```

Example `ansible.cfg` snippets used in the repository (control node):


If you prefer not to pass `-i inventory.ini` when running `ansible-playbook`, each project directory already contains an `ansible.cfg` that points to its local `inventory.ini`. Below are the exact `ansible.cfg` contents used for each method (copy these into the corresponding project directory if you edit them):

`ways-to-install-docker/install-docker-from-apt/ansible.cfg`

```ini
[defaults]
inventory=./inventory.ini
remote_user=admin
ask_pass=no

[privilege_escalation]
become=true
become_method=sudo
become_user=root
become_ask_pass= false
```

`ways-to-install-docker/install-docker-from-script/ansible.cfg`

```ini
[defaults]
inventory = ./inventory.ini
remote_user = admin 
ask_pass = false 

[privilege_escalation]
become = true
become_method = sudo
become_user = root
become_ask_pass = false
```

`ways-to-install-docker/install-docker-from-role/ansible.cfg`

```ini
[defaults]
inventory=./inventory.ini
remote_user=admin
ask_pass=no
role_path=/home/Heisenberg/.ansible/roles

[privilege_escalation]
become=true
become_method=sudo
become_user=root
become_ask_pass=false
```

## Running the PetClinic examples

Two example projects are in `working-area`:

- `docker-petclinic`: simple app delivered as a single container.
- `full-petclinic`: multi-service deployment (app, DB, reverse proxy, monitoring) via Docker Compose and roles.

### 1. docker-petclinic (simple)

This project demonstrates building a Docker image and running the container via an Ansible role. The role `docker-works` in `working-area/docker-petclinic/roles/docker-works` contains tasks to build and run the image from the `Dockerfile`.

To deploy from the control node:

```bash
cd working-area/docker-petclinic
ansible-playbook playbook.yaml
```

Then open http://<host-ip>:8080 or run a quick check:

```bash
curl -fsS http://127.0.0.1:8080/ || echo "service not reachable"
```

### 2. full-petclinic (multi-service)

`full-petclinic` uses a role `deploy-petclinic-app` that places compose files and runs Docker Compose to bring up multiple services (app, postgres, nginx, monitoring stack).

From the control node:

```bash
cd working-area/full-petclinic
ansible-playbook playbook.yaml --private-key full-petclinic-2.pem
```

The role typically uploads `docker-compose.yml` and runs:

```bash
docker compose up -d
```

Verify the stack:

```bash
docker compose ps
curl -fsS http://<host-ip>:8080/ || echo "full-petclinic not reachable"
```

## Verification & troubleshooting

- Check service status on the managed node:

```bash
ssh -i docker-petclinic.pem ubuntu@<host-ip> "sudo systemctl status docker"
```

- Use `ansible -m ping all -i inventory.ini` to confirm connectivity.
- Check Docker version:

```bash
ssh -i docker-petclinic.pem ubuntu@<host-ip> "docker --version && docker compose version"
```