<h1 align="center">Minimal Store System</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-8.0-orange" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

<p align="center">A minimal store system with three different roles: Employee, Admin, and Store Executive.</p>

<h2>System Overview</h2>

<p>The system aims to create a minimal store system with the following roles:</p>

<ol>
  <li>Employee</li>
  <li>Admin</li>
  <li>Store Executive</li>
</ol>

<h2>Testing the Project</h2>

<p>To test the project, follow these steps:</p>

<ol>
  <li>Clone the repository to your local machine:</li>
</ol>

<pre><code>git clone https://github.com/your-username/store-system.git
</code></pre>

<ol start="2">
  <li>Navigate to the project directory:</li>
</ol>

<pre><code>cd store-system
</code></pre>

<ol start="3">
  <li>Install PHP dependencies:</li>
</ol>

<pre><code>composer install
</code></pre>

<ol start="4">
  <li>Install JavaScript dependencies:</li>
</ol>

<pre><code>npm install
</code></pre>

<ol start="5">
  <li>Set up the database and user credentials in the <code>.env</code> file.</li>
</ol>

<ol start="6">
  <li>Run the database migrations and seed the database with dummy data:</li>
</ol>

<pre><code>php artisan migrate --seed
</code></pre>

<p>The migrations will create the necessary tables, and the seeders will populate the tables with dummy data.</p>

<h3>User Credentials</h3>

<p>Use the following email and password combinations for testing:</p>

<ul>
  <li><strong>Admin User:</strong> Email: admin@gmail.com, Password: 123456</li>
  <li><strong>Employee User:</strong> Email: employee@gmail.com, Password: 123456</li>
  <li><strong>Store Executive User:</strong> Email: store.executive@gmail.com, Password: 123456</li>
</ul>

<h2>Running the Project</h2>

<p>To start the development server, run the following command:</p>

<pre><code>php artisan serve
</code></pre>

<p>This will start the server, and you can access the application by visiting <a href="http://localhost:8000">http://localhost:8000</a> in your web browser.</p>

<p>To compile assets during development, you can run:</p>

<pre><code>npm run watch</code></pre>

<p>For production, you can run:</p>

<pre><code>npm run prod</code></pre>

<h2>Contributing</h2>

<p>Contributions are welcome! If you find any issues or want to add new features, feel free to open a pull request.</p>

<h2>License</h2>

<p>This project is open-source and available under the <a href="LICENSE">MIT License</a>.</p>
