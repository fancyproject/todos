How to start:

1. Clone project
```
git clone https://github.com/fancyproject/todos
cd todos
```

2. Run command
```
docker-compose up -d --build
```

3. Add host to /etc/hosts:

```
127.0.0.1 todos.local
```

4. Run command 

```
docker exec -it todos  /bin/bash
```

5. and in container run

```
./build.sh
```



