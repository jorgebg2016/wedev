FROM nerd4ever/bee:latest

RUN rm -rf /var/lib/apt/lists/*

RUN apt update -y && apt install curl -y
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
RUN apt install nodejs -y

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
RUN apt update -y && apt install yarn -y

COPY ./apache2.conf /etc/apache2/sites-enabled/vhost-bee.conf
COPY ./docker-server-entrypoint.sh docker-server-entrypoint.sh
RUN chmod +x docker-server-entrypoint.sh

COPY ./backend /var/www/html
RUN cd /var/www/html
RUN chown nerd4ever:nerd4ever -R /var/www/html
RUN chmod 0777 -R /var/www/html/storage
RUN composer self-update

COPY ./front /var/www/frontend
RUN cd /var/www/frontend
RUN chown nerd4ever:nerd4ever -R /var/www/frontend

RUN cd /
RUN sed -i -e 's/\r$//' ./docker-server-entrypoint.sh
CMD ["/docker-server-entrypoint.sh"]

