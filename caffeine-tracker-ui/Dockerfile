FROM node:16-alpine AS build
WORKDIR /app

COPY package.json /app/
RUN npm install
COPY ./ /app/
RUN npm run build

FROM nginx:1.17.1-alpine
COPY --from=build /app/build/ /usr/share/nginx/html
COPY default.conf /etc/nginx/conf.d/default.conf
EXPOSE 80