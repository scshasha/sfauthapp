FROM nginx

RUN rm /etc/nginx/nginx.conf
COPY nginx.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf
# RUN rm /etc/nginx/sites-available/default.conf
COPY sites/default.conf /etc/nginx/sites-available/default.conf

CMD ["nginx"]

EXPOSE 80 443
