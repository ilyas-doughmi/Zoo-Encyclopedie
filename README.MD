# Zoo Encyclopedie - Web Application

A complete web-based administration system for a Zoo Encyclopedia. This application is designed for educational purposes, allowing children to learn about animals while giving educators a powerful tool to manage the zoo's database (animals, habitats, diets).


## Project Overview
The **Zoo Encyclopedie** application allows users (educators/administrators) to:
- Manage a digital encyclopedia of animals.
- Categorize animals by **Habitats** (e.g., Savane, Jungle) and **Diets** (Carnivore, Herbivore).
- Visualize zoo statistics in real-time.
- Provide a "Discovery Mode" interface suitable for children.

## Features

### 1. Administrator Dashboard
- **Real-time Statistics:** Displays total count of animals and active habitats.
- **Connection Status:** Live indicator showing if the database is Online or Offline.
- **Quick Actions:** Shortcuts to add animals or configure zones.

### 2. Animal Management (Encyclopedia)
- **CRUD Operations:** Create, Read, Update, and Delete animal records.
- **Smart Filtering:** Filter the animal grid by:
  - **Habitat** (Dynamic list from database)
  - **Diet** (Carnivore, Herbivore, Omnivore)
- **Visual Cards:** Animals are displayed as cards with their image, name, and diet tag.

### 3. Habitat & Zone Management
- **Dynamic Zones:** Create new habitats (e.g., "Aquarium", "Desert") with descriptions.
- **Population Tracking:** Automatically counts how many species reside in each habitat.
- **Management:** Edit or Delete existing habitats directly from the UI.

## Tech Stack
- **Frontend:** HTML5, Tailwind CSS (via CDN), JavaScript (Vanilla), Lucide Icons.
- **Backend:** Native PHP (Procedural style).
- **Database:** MySQL.
- **Architecture:** MVC-inspired (Logic in `php/`, Views in `index.php`, Data in `sql/`).

## Folder Structure
```text
Zoo-Encyclopedie/
├── Modélisation/          # UML and ERD Diagrams
│   ├── ERD_Database_Model.png.png
│   └── UML_Use_Case.png
├── php/                   # Backend Logic
│   ├── animals.php        # Handle Animal CRUD & Filtering
│   ├── habitat.php        # Handle Habitat CRUD
│   └── connexion.php      # Database connection settings
├── sql/                   # Database Scripts
│   └── install.sql        # Setup script (Create DB & Tables)
├── index.php              # Main Application Entry Point
├── img.php                # Image testing utility
└── test.php               # Connection testing utility
````

## Database Setup

The project uses a relational database named `zoo_encycloedie`.

### Schema Overview

1.  **Table `Habitat`**
      * `id_hab` (Primary Key)
      * `name_hab` (Name of the zone)
      * `desc_hab` (Description)
2.  **Table `Animal`**
      * `id` (Primary Key)
      * `name_anim` (Name)
      * `type_alimentaire` (Diet)
      * `anim_image` (Image URL)
      * `habitat_id` (Foreign Key linking to `Habitat`)


## Installation Guide

### Prerequisites

  - A local web server (XAMPP, WAMP, MAMP, or LAMP stack).
  - PHP 7.4+
  - MySQL Server.

## Modeling

The project includes design documents located in the `Modélisation/` folder:

  - **ERD Model:** Visualizes the relationship between Animals and Habitats.
  - **Use Case Diagram:** Outlines the interactions for "Educator" and "Child" actors.


