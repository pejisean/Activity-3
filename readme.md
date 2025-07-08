<a name="readme-top">

<br/>

<br />
<div align="center">

  <!-- TODO: If you want to add logo or banner you can add it here -->

<!-- TODO: Change Title to the name of the title of your Project -->
  <h3 align="center">Activity-3</h3>
</div>
<!-- TODO: Make a short description -->
<div align="center">
  Short Description. (Optional)
</div>

<br />

<!-- TODO: Change the zyx-0314 into your github username  -->
<!-- TODO: Change the WD-Template-Project into the same name of your folder -->

![](https://visit-counter.vercel.app/counter.png?page=zyx-0314/AD-CI4-Template-Project)

[![wakatime](https://wakatime.com/badge/user/018dd99a-4985-4f98-8216-6ca6fe2ce0f8/project/63501637-9a31-42f0-960d-4d0ab47977f8.svg)](https://wakatime.com/badge/user/018dd99a-4985-4f98-8216-6ca6fe2ce0f8/project/63501637-9a31-42f0-960d-4d0ab47977f8)

---

<br />
<br />

<!-- TODO: If you want to add more layers for your readme -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rule,-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

<!-- TODO: To be changed -->
<!-- The following are just sample -->

Description of the project in details.

### Key Components

<!-- TODO: List of Key Components -->
<!-- The following are just sample -->

- Authentication & Authorization
- CRUD Operations for Invetory System

### Technology

#### Language
![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

#### Framework/Library
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

#### Databases
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white)

#### Deployment
![Vercel](https://img.shields.io/badge/Vercel-000000?style=for-the-badge&logo=vercel&logoColor=white)

## Rules, Practices and Principles

<!-- Do not Change this -->

1. Always use `AD-` in the front of the Title of the Project for the Subject followed by your custom naming.
2. Do not rename `.php` files if they are pages; always use `index.php` as the filename.
3. Add `.component` to the `.php` files if they are components code; example: `footer.component.php`.
4. Add `.util` to the `.php` files if they are utility codes; example: `account.util.php`.
5. Place Files in their respective folders.
6. Different file naming Cases
   | Naming Case | Type of code         | Example                           |
   | ----------- | -------------------- | --------------------------------- |
   | Pascal      | Utility              | Accoun.util.php                   |
   | Camel       | Components and Pages | index.php or footer.component.php |
8. Renaming of Pages folder names are a must, and relates to what it is doing or data it holding.
9. Use proper label in your github commits: `feat`, `fix`, `refactor` and `docs`
10. File Structure to follow below.

```
Activity-3
├── assets
│   ├── css
│   ├── img
│   └── js
├── handlers
│   └── mongodbChecker.handler.php
├── pages
│   └── dashboard
│       └── index.php
├── utils
│   ├── auth.util.php
│   ├── dbResetPostgresql.util.php
│   └── envSetter.util.php
├── vendor
├── .env
├── bootstrap.php
├── composer.json
├── index.php
└── readme.md

```
> The following should be renamed: name.css, name.js, name.jpeg/.jpg/.webp/.png, name.component.php(but not the part of the `component.php`), Name.utils.php(but not the part of the `utils.php`)

## Resources

<!-- TODO: Add References -->

## Resources

| Title               | Purpose                                                                                     | Link                                  |
|---------------------|---------------------------------------------------------------------------------------------|-------------------------------------|
| MDN Web Docs        | A great resource for learning and referencing HTML, CSS, and JavaScript web technologies.   | [https://developer.mozilla.org/](https://developer.mozilla.org/) |
| PHP Manual          | The official PHP documentation with examples and explanations for all PHP features.         | [https://www.php.net/manual/en/](https://www.php.net/manual/en/) |
| Tailwind CSS Docs   | The official guide to using Tailwind CSS, including utilities and customization options.    | [https://tailwindcss.com/docs](https://tailwindcss.com/docs)       |
| Bootstrap Docs      | Comprehensive documentation for Bootstrap’s components and responsive design system.        | [https://getbootstrap.com/docs/](https://getbootstrap.com/docs/)   |
| MongoDB Manual      | Official documentation for MongoDB, covering installation, usage, and advanced features.    | [https://docs.mongodb.com/](https://docs.mongodb.com/)             |
| PostgreSQL Docs     | Detailed documentation for PostgreSQL database, including SQL commands and configuration.    | [https://www.postgresql.org/docs/](https://www.postgresql.org/docs/) |
| Docker Documentation| Guides and tutorials for containerizing applications and managing Docker environments.       | [https://docs.docker.com/](https://docs.docker.com/)               |
