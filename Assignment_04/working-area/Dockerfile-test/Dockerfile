FROM nginx

WORKDIR /usr/share/nginx/sites/docker/

COPY index.html .

ADD site.conf.tar /etc/nginx/conf.d/

ENV MADE_BY="Heisenberg"

ARG UPDATE_PACKAGES="apt-get update"

ARG INSTALL_BTOP="apt-get install -y htop"

RUN ${UPDATE_PACKAGES} && ${INSTALL_BTOP}

ENTRYPOINT ["nginx"]

CMD ["-g", "daemon off;"]

