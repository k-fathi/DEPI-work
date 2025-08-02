## Nginx & PHP-FPM Setup Task

### Applied Topics
- **Nginx:** web server, reverse proxy (via socket & port), caching (two methods), logs (access & error), redirection.

---

### Step-by-Step Task List

1. **Install and Start Nginx**
    ```bash
    sudo apt update
    sudo apt install nginx
    sudo systemctl start nginx
    ```

2. **Install PHP-FPM**
    - PHP-FPM is the FastCGI Process Manager for PHP.
    ```bash
    sudo apt install php-fpm
    ```

3. **Clone a PHP Repository from GitHub**
    ```bash
    git clone https://github.com/stefan-klaes/super-simple-php-website.git /var/www/sites/super-simple-php-website
    ```

4. **Locate the Project Directory**
    - Ensure your PHP files are in `/var/www/sites/super-simple-php-website`.

5. **Configure Nginx to Use PHP-FPM via Socket**
    - Edit `/etc/php/8.1/fpm/pool.d/www.conf`:
      ```
      listen = /run/php/php-fpm.sock
      ```
    - Ensure the above line is **not commented**.

6. **Configure Nginx Server Block to Serve PHP Files**

    ```nginx
    server {
       # listen 85; # via Socket
         listen 89; # via Port
         server_name simple-php-website.com;
         root /var/www/sites/super-simple-php-website;
         index index.php index.html index.htm;

         location / {
              try_files $uri $uri/ /index.php?$args;
         }

         # location for test-images 
         location /images/ {
          root /var/www/sites/super-simple-php-website;
         }

         # Redirection
         location /home {
         # rewrite ^/home/?$ / last;
            return 301 /;
         }

         location ~ \.php$ {
              include snippets/fastcgi-php.conf;
              #fastcgi_pass unix:/run/php/php-fpm.sock;
              fastcgi_pass 127.0.0.1:9000;

              # Nginx caching
              fastcgi_cache PHP_CACHE;
              fastcgi_cache_valid 200 60m;
              fastcgi_cache_methods GET HEAD;
              fastcgi_ignore_headers Cache-Control Expires Set-Cookie;
              fastcgi_no_cache 0;
              fastcgi_cache_bypass 0;
         }

         # Deny access to hidden files
         location ~ /\.(ht|git) {
              deny all;
         }

         # Browser Caching 
         location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|webp|woff2|ttf)$ {
              expires 30d; # 300s, 60m, 24h, 6M, 1y, 1h 30m, off, max, ...etc
              add_header Cache-Control "public, no-transform";
         }

         # Logs
         access_log /var/log/nginx/sites/super-simple-php-website/access.log;
         error_log  /var/log/nginx/sites/super-simple-php-website/error.log;
    }
    ```

    - Create any used directories if they do not exist.
    - Change the Owner of the directories to `www-data:www-data`:
      ```bash
      sudo chown -R www-data:www-data /var/www/sites/super-simple-php-website
      sudo chown -R www-data:www-data /var/log/nginx/sites/super-simple-php-website
      sudo chown -R www-data:www-data /var/cache/nginx
      ```
    - Reload Nginx after changes.

7. **Configure Nginx to Use PHP-FPM via Port**
    - Edit `/etc/php/8.1/fpm/pool.d/www.conf`:
      ```
      ;listen = /run/php/php-fpm.sock # make sure this line is commented by `;`
      listen = 127.0.0.1:9000
      ```
    - Update Nginx location block:
      ```nginx
      location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass 127.0.0.1:9000;
      }
      ```

---

### Nginx Caching Configuration

```nginx
http {
     fastcgi_cache_path /var/cache/nginx levels=1:2 keys_zone=PHP_CACHE:100m inactive=60m;
     fastcgi_cache_key "$scheme$request_method$host$request_uri";
     server { ... }
}
```

---

### Test and Restart Commands

```bash
sudo nginx -t         # Test Nginx configuration for syntax errors
sudo nginx -s reload  # Reload Nginx
sudo systemctl restart nginx
```

## Nginx & PHP-FPM Architecture
### The Request Journey
1. **Client Request**: A client (browser) sends a request to the Nginx server.
2. **Browser Processing**: The Browser check if the requested resource is cached.
3. **Cache Hit**: If the resource is cached, the browser will directly give it to the user.
4. **Cache Miss**: If not cached, the browser forwards the request to nginx.
5. **Nginx Processing**: Nginx processes the request, checking if the requested resource is cached.
6. **Cache Hit**: If the resource is cached, Nginx serves it directly from the cache to the browser.
7. **Cache Miss**: If not cached, Nginx forwards the request to PHP-FPM via Fast_CGI protocol using socket file or Port method.
8. **PHP-FPM Processing**: PHP-FPM processes the PHP script and returns the response to Nginx also using Fast_CGI protocol.
9. **Response to Client**: Nginx sends the final response back to the client.


### Log Levels

| Level   | Description                                  |
|---------|----------------------------------------------|
| emerg   | Emergency: system unusable                   |
| alert   | Immediate action required                    |
| crit    | Critical conditions                         |
| error   | Error conditions                            |
| warn    | Warning conditions                          |
| notice  | Significant but normal conditions           |
| info    | Informational messages                      |
| debug   | Debug-level messages                        |

---

### HTTP Status Codes

- **1xx: Informational**
  - 100: Continue
  - 101: Switching Protocols
- **2xx: Success**
  - 200: OK
  - 201: Created
  - 202: Accepted
  - 204: No Content
- **3xx: Redirection**
  - 301: Moved Permanently
  - 302: Found (Temporary Redirect)
  - 304: Not Modified
  - 307: Temporary Redirect
  - 308: Permanent Redirect
- **4xx: Client Error**
  - 400: Bad Request
  - 401: Unauthorized
  - 403: Forbidden
  - 404: Not Found
- **5xx: Server Error**
  - 500: Internal Server Error
  - 502: Bad Gateway
  - 503: Service Unavailable
  - 504: Gateway Timeout
