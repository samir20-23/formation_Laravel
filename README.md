<div>
</dev>
<div id="badges"  align="center">


  </div>
<div id="header" align="center">

 [![Typing SVG](https://readme-typing-svg.herokuapp.com/?color=da3b29&lines=L+a+r+v+e+l)](https://git.io/typing-svg)
  
</div>

<div id="header" align="center">
  <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExeWVqMGJrdDgwNGIxdGxkZ2V3Z21kNGhuengwaGIxZnQzZTQ3NXBiNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/26DoiqmYcxgFICb3G/giphy.gif" width="340"/>
       </a>
</div>

Here are the steps to create a Laravel project using AdminLTE and Laravel UI:

1. Create a new Laravel project:
   ```bash
   composer create-project laravel/laravel project_name
   ```

2. Navigate into the project directory:
   ```bash
   cd project_name
   ```

3. Install Laravel UI:
   ```bash
   composer require laravel/ui
   ```

4. Generate authentication scaffolding:
   ```bash
   php artisan ui bootstrap --auth
   ```

5. Install NPM dependencies:
   ```bash
   npm install
   ```

6. Install AdminLTE package via NPM:
   ```bash
   npm install admin-lte
   ```

7. Publish the AdminLTE assets (if needed):
   ```bash
   npm run dev
   ```

8. Set up your `resources/js/app.js` to include AdminLTE:
   ```js
   import 'admin-lte';
   ```

9. Modify `resources/sass/app.scss` to import AdminLTE styles:
   ```scss
   @import "~admin-lte/dist/css/adminlte.min.css";
   ```

10. Run the development server:
    ```bash
    npm run dev
    ```

11. (Optional) Configure routes, views, and controllers to use AdminLTE layout.
