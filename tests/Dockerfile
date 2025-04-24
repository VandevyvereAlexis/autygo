FROM node:lts-alpine

WORKDIR /autygo-tests

COPY package*.json ./
RUN npm install

COPY . .

CMD ["npm", "run", "test"]