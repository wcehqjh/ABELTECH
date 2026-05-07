# =========================================
# 🚀 CRÉATION PROJET LARAVEL ABELTECH
# =========================================

composer create-project laravel/laravel abeltech

cd abeltech

# =========================================
# 📦 INSTALL PACKAGES
# =========================================

npm install
npm install bootstrap @popperjs/core alpinejs sass
npm install sweetalert2 aos

# =========================================
# 🔐 AUTHENTIFICATION
# =========================================

composer require laravel/breeze --dev

php artisan breeze:install blade

npm install && npm run build

# =========================================
# 🗃️ MODELS + MIGRATIONS + CONTROLLERS
# =========================================

php artisan make:model Product -mfs
php artisan make:model ProductImage -mfs
php artisan make:model Category -mfs
php artisan make:model Order -mfs
php artisan make:model OrderItem -mfs

php artisan make:controller Shop/ProductController
php artisan make:controller Shop/CartController
php artisan make:controller Admin/ProductController --resource
php artisan make:controller Admin/DashboardController

# =========================================
# 🛡️ MIDDLEWARE + POLICY + REQUESTS
# =========================================

php artisan make:middleware AdminMiddleware

php artisan make:policy ProductPolicy --model=Product

php artisan make:request StoreProductRequest
php artisan make:request UpdateProductRequest

# =========================================
# 🧠 SERVICES + REPOSITORIES
# =========================================

mkdir -p app/Services
mkdir -p app/Repositories

touch app/Services/ProductService.php
touch app/Repositories/ProductRepository.php

# =========================================
# 📁 VIEWS
# =========================================

mkdir -p resources/views/layouts
mkdir -p resources/views/partials
mkdir -p resources/views/shop
mkdir -p resources/views/cart
mkdir -p resources/views/admin/products
mkdir -p resources/views/admin/dashboard

touch resources/views/layouts/app.blade.php
touch resources/views/layouts/admin.blade.php

touch resources/views/shop/index.blade.php
touch resources/views/shop/show.blade.php

touch resources/views/cart/index.blade.php

touch resources/views/admin/dashboard/index.blade.php

touch resources/views/admin/products/index.blade.php
touch resources/views/admin/products/create.blade.php
touch resources/views/admin/products/edit.blade.php

touch resources/views/partials/navbar.blade.php
touch resources/views/partials/footer.blade.php
touch resources/views/partials/product-card.blade.php
touch resources/views/partials/pagination.blade.php

# =========================================
# 🎨 CSS + JS + ASSETS
# =========================================

mkdir -p public/assets/css
mkdir -p public/assets/js
mkdir -p public/assets/img

touch public/assets/css/style.css
touch public/assets/js/script.js

# =========================================
# 🌱 SEEDERS + FACTORIES
# =========================================

php artisan make:factory ProductFactory
php artisan make:factory CategoryFactory

php artisan make:seeder ProductSeeder
php artisan make:seeder CategorySeeder

# =========================================
# 🔗 STORAGE LINK
# =========================================

php artisan storage:link

# =========================================
# ⚙️ MIGRATION DATABASE
# =========================================

php artisan migrate

# =========================================
# 🌱 SEED DEMO DATA
# =========================================

php artisan db:seed

# =========================================
# ⚡ RUN PROJECT
# =========================================

npm run dev

php artisan serve