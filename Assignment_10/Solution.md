# Assignment 10: Jenkins Setup with Docker Compose

## Task
Deploy Jenkins using Docker Compose as described in the provided `docker-compose.yaml` file.

## Provided Compose File
The `docker-compose.yaml` file defines a Jenkins service:

```yaml
version: '3'
services:
	jenkins:
		image: jenkins/jenkins:lts
		container_name: jenkins
		ports:
			- '8080:8080'
		dns:
			- 8.8.8.8
			- 1.0.0.1
		volumes:
			- jenkins-data:/var/jenkins_home/
		networks:
			- jenkins-net
		restart: always

volumes:
	jenkins-data: {}

networks:
	jenkins-net: {}
```
##  👉 You can find it [HERE](working-area/docker-compose.yaml)
## Solution Steps

### 1. Prerequisites
- Ensure Docker and Docker Compose are installed on your machine.
- Verify you have enough resources (RAM, CPU) for Jenkins.

### 2. Start Jenkins
Navigate to the directory containing `docker-compose.yaml` and run:

```bash
docker-compose up -d
```

This will pull the Jenkins image, create the necessary volume and network, and start the Jenkins container in detached mode.

### 3. Access Jenkins
- Open your browser and go to [http://localhost:8080](http://localhost:8080).
- The initial admin password can be found in the container at `/var/jenkins_home/secrets/initialAdminPassword`.
	To retrieve it, run:
	```bash
	docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword
	```

### 4. Persistent Data
- Jenkins data is stored in the Docker volume `jenkins-data`, ensuring persistence across container restarts.

### 5. Custom DNS
- The container uses custom DNS servers (8.8.8.8 and 1.0.0.1) for network resolution.

### 6. Restart Policy
- The `restart: always` policy ensures Jenkins restarts automatically if the container stops or the host reboots.

## Troubleshooting
- If Jenkins does not start, check logs with:
	```bash
	docker-compose logs jenkins
	```
- Ensure port 8080 is not in use by another service.

## You can access Jenkins at: http://localhost:8080
## You can find the jenkins initial password:
    - in the output of the logs
    - here: /var/jenkins_home/secrets/initialAdminPassword inside the container

![](Jenkins.svg)