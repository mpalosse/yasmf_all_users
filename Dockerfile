FROM mysql:8

ENV MYSQL_DATABASE=all_users \
    MYSQL_USER=all_users \
    MYSQL_PASSWORD=all_users \
    MYSQL_ROOT_PASSWORD=<password>

ADD SQL/schema.sql /docker-entrypoint-initdb.d

EXPOSE 3306