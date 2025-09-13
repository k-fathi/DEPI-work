# Start from the official Jenkins image
FROM jenkins/jenkins:lts

# Switch to the root user to install packages
USER root

# 1. Install prerequisites
RUN apt-get update && apt-get install -y curl ca-certificates gnupg

# 2. Add Docker's official GPG key
RUN install -m 0755 -d /etc/apt/keyrings
RUN curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
RUN chmod a+r /etc/apt/keyrings/docker.asc

# 3. Set up the repository
RUN echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  tee /etc/apt/sources.list.d/docker.list > /dev/null

# 4. Install Docker CLI and Compose Plugin
RUN apt-get update && apt-get install -y docker-ce-cli docker-compose-plugin

# 5. Create the docker group BEFORE trying to use it
RUN groupadd docker

# 6. Add jenkins user to the docker group
RUN usermod -aG docker jenkins

# 7. Switch back to the jenkins user for the final image state
USER jenkins