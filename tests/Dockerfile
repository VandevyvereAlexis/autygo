FROM node:lts-alpine

WORKDIR /autygo-tests

# Copie des dépendances
COPY package*.json ./
RUN npm install

# Ajout de l'argument pour choisir l'env
ARG MODE=test
COPY .env.${MODE} .env

# Copie du reste du code
COPY . .

# Lancement des tests
CMD ["npm", "run", "test"]