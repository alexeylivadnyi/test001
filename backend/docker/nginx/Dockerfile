FROM nginx:stable-alpine

MAINTAINER livalex

COPY nginx.conf /etc/nginx/nginx.conf
COPY nginx.vh.default.conf /etc/nginx/conf.d/default.conf
COPY nginx.vh.frontend.conf /etc/nginx/conf.d/frontend.conf

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
