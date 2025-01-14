FROM node:latest as web-node

RUN apt-get update && apt-get install -y nginx

# Set working directory
WORKDIR /app

COPY ./andele-vue/package*.json ./

# Install dependencies
RUN npm install

COPY ./andele-vue/ .

# Build app
RUN npm run build

ENTRYPOINT ["nginx", "-g", "daemon off;"]

#ENTRYPOINT ["npm", "run", "dev","--","--port","3000","--host"]

