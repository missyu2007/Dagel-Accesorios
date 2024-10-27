<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap');

* {
  padding: 0;
  box-sizing: border-box;
  font-family: 'Cormorant Garamond', serif;
}


body {
  background-color: #F2f2f2;
  font-size: 19px;
}

header {
  background-color: #d4d9cc;
  width: 100%;
  clear: both;
  content: "";
  display: table;
}

.menu {
  width: 100%;
  margin: 0 auto;
}

.dagelogo { 
  width: 80px; 
  height: 80px;
  border-radius: 60%; 
  object-fit: cover; 
}

img {
  width: 200px;
  height: 90px;
  float: left;
  padding: 8px;
}

nav {
  float: right;
}

nav ul {
  display: flex;
  justify-content: center;
  align-items: center;
}

nav ul li {
  list-style: none;
  margin-left: 65px;
  padding: 12px 0;
  position: relative;
  display: inline-block;
  margin: 0 25px;
}

nav ul li a {
  text-decoration: none;
  color: #4e5925;
  font-weight: bold;
}

nav ul li a:before {
  display: block;
  content: "";
  width: 0%;
  background: #9fa685;
  height: 5px;
  top: 0;
  position: absolute;
  transition: width 0.2s;
}

nav ul li a:hover:before {
  width: 100%;
}


@media (max-width: 768px) {
  nav ul {
    flex-direction: column;
    position: absolute;
    top: 100px;
    right: 0;
    background-color: #d4d9cc;
    width: 100%;
    display: none; 
  }

  nav ul li {
    margin: 0;
    padding: 15px;
    text-align: center;
  }

  .menu-icon {
    display: block;
    float: right;
    padding: 15px;
    cursor: pointer;
  }

  .menu-icon span {
    display: block;
    width: 30px;
    height: 3px;
    margin: 5px;
    background-color: #4e5925;
  }

  
  nav.active ul {
    display: flex;
  }
}

nav ul {
  transition: max-height 0.3s ease-in-out;
}
</style>

<header>
  <div class="menu">
    <img src="dagelogo.jpg" class="dagelogo" alt="Logo">
    <div class="menu-icon">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <nav>
      <ul>
        <li><a href="../index/index.php">Inicio</a></li>
        <li><a href="#about">Acerca de</a></li>
        <li><a href="#services">Servicios</a></li>
        <li><a href="#contact">Contacto</a></li>
        <li><a href="../login.php">Iniciar Seccion</a></li>
      </ul>
    </nav>
  </div>
</header>