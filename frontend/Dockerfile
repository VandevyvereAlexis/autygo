FROM node:lts-alpine AS build-stage

WORKDIR /app

# Install des dépendances
COPY package*.json ./
RUN npm install

# Copie du bon fichier d'env en fonction du mode
ARG MODE=test
COPY .env.${MODE} .env

# Copie du reste du code
COPY . .

# Build de production
RUN npm run build

# Étape de déploiement : Nginx
FROM nginx:stable-alpine as production-stage

COPY --from=build-stage /app/dist /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]