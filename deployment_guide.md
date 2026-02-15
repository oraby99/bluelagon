# Deployment Guide

Here are the manual steps to deploy your application to the server.

> [!NOTE]
> **Need to install NPM on the server?**
> If you are on a shared hosting (cPanel/Namecheap/etc) and `npm` is missing:
> 1. Run this command to install NVM (Node Version Manager):
>    ```bash
>    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
>    ```
> 2. Activate it:
>    ```bash
>    source ~/.bashrc
>    ```
> 3. Install Node.js:
>    ```bash
>    nvm install --lts
>    ```
> 4. Now `npm` should work!

> [!WARNING]
> **If `npm` is strictly not allowed on your server:**
> Do **Step 6** on your **LOCAL machine** (computer) first, then upload the `public/build` folder to your server's `public/` directory.

## Prerequisites
- SSH Access to your server.
- Git, Composer, NPM installed.

## Steps

1. **Navigate to Project Directory**
   ```bash
   cd /path/to/your/project
   ```

2. **Pull Latest Changes**
   ```bash
   git pull origin main
   ```

3. **Install Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

5. **Clear & Cache Configuration**
   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan event:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Build Frontend Assets**
   *If `npm` works on server:*
   ```bash
   npm install
   npm run build
   ```
   *If `npm` fails:*
   **Option A (Manual Upload):**
   - Run `npm run build` on your **local computer**.
   - Compress/Zip the `public/build` folder.
   - Upload it to `public/build` on the server.

   **Option B (Git Commit - EASIEST):**
   1. On Local: Open `.gitignore` and remove `/public/build`.
   2. Run `npm run build`.
   3. Commit the changes:
      ```bash
      git add public/build .gitignore
      git commit -m "Include build assets"
      git push origin main
      ```
   4. On Server:
      ```bash
      git pull origin main
      ```

7. **Optimize Filament (Optional)**
   ```bash
   php artisan filament:optimize
   ```

8. **Restart Queue Workers (If applicable)**
   ```bash
   php artisan queue:restart
   ```

9. **Bring Application Up**
   ```bash
   php artisan up
   ```
