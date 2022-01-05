FROM nginx:1.12.0
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./server /work
ADD ./docker/nginx/localhost.pem /etc/certs/localhost.pem
ADD ./docker/nginx/localhost-key.pem /etc/certs/localhost-key.pem
EXPOSE 80