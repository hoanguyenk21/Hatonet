FROM node:16-alpine3.15

WORKDIR /app

ADD . /app/


RUN npm install --production

RUN npm run build

RUN npm install pm2 -g

EXPOSE 3001
