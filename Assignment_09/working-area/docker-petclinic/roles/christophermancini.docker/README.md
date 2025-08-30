# Ansible Docker

[![Build Status](https://travis-ci.org/christophermancini/ansible-docker.svg?branch=master)](https://travis-ci.org/christophermancini/ansible-docker)
[![CircleCI](https://circleci.com/gh/christophermancini/ansible-docker.svg?style=svg)](https://circleci.com/gh/christophermancini/ansible-docker)
[![Ansible Galaxy](https://img.shields.io/ansible/role/18897.svg?maxAge=2592000)](https://galaxy.ansible.com/christophermancini/docker/)

**Ansible Docker** is a simple role to install Docker on RHEL or Debian based Linux distros using the Official Docker repositories.

## Install

You can install this Ansible role using the Ansible Galaxy command line tool, `ansible-galaxy`:

```bash
ansible-galaxy install christophermancini.docker
```

## Sample Playbook

```yaml
---
- hosts: localhost
  become_method: sudo
  connection: local
  roles:
    - { role: christophermancini.docker }
  vars:
    docker_images:
      - mariadb:10
      - golang:latest
```
