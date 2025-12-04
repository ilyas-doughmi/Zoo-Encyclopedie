<?php
include("php/connexion.php");
include("php/animals.php");
include("php/habitat.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Encyclopédie - Administration</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config for Custom Colors/Fonts -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Fredoka', 'sans-serif'],
                    },
                    colors: {
                        zoo: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10b981',
                            600: '#059669',
                            900: '#064e3b',
                            dark: '#022c22',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Base Styles */
        body {
            background-color: #f8fafc;
        }

        /* Smooth Animations */
        .transition-all-300 {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fade In Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered Delays for List Items */
        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        .stagger-3 {
            animation-delay: 0.3s;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Card Hover Lift */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        /* Glass Effect */
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="text-slate-800 h-screen flex overflow-hidden selection:bg-zoo-100 selection:text-zoo-900">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-white border-r border-slate-200 hidden md:flex flex-col z-30 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-8 border-b border-slate-50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-zoo-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-zoo-500/30 transform rotate-3">
                    <i data-lucide="paw-print" class="w-6 h-6 fill-current"></i>
                </div>
                <div>
                    <h1 class="font-display font-bold text-xl tracking-tight text-slate-800">ZooAdmin</h1>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Pro v1.0</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <div class="px-4 mb-2">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menu Principal</p>
            </div>

            <button onclick="switchTab('dashboard')" id="nav-dashboard" class="nav-item group w-full flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-xl transition-all-300 bg-zoo-50 text-zoo-600 border border-zoo-100">
                <i data-lucide="layout-grid" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                Tableau de bord
            </button>

            <button onclick="switchTab('animals')" id="nav-animals" class="nav-item group w-full flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all-300 border border-transparent">
                <i data-lucide="cat" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                Encyclopédie
            </button>

            <button onclick="switchTab('habitats')" id="nav-habitats" class="nav-item group w-full flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-900 transition-all-300 border border-transparent">
                <i data-lucide="map" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                Habitats & Zones
            </button>



        </nav>


    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <!-- Top Mobile Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex md:hidden items-center justify-between px-4 z-40 sticky top-0">
            <div class="flex items-center gap-2">
                <div class="bg-zoo-500 p-1.5 rounded-lg text-white"><i data-lucide="paw-print" class="w-5 h-5"></i></div>
                <span class="font-display font-bold text-lg text-slate-800">ZooAdmin</span>
            </div>
            <button class="p-2 text-slate-500 bg-slate-50 rounded-lg hover:bg-slate-100"><i data-lucide="menu" class="w-6 h-6"></i></button>
        </header>

        <!-- MAIN SCROLLABLE AREA -->
        <main class="flex-1 overflow-y-auto bg-[#F8FAFC] p-4 md:p-8 scroll-smooth relative">

            <!-- Background Decorations -->
            <div class="fixed top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-zoo-100 rounded-full blur-3xl opacity-50 pointer-events-none z-0"></div>
            <div class="fixed bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none z-0"></div>

            <div class="relative z-10 max-w-7xl mx-auto space-y-8 pb-12">

                <!-- DASHBOARD VIEW -->
                <div id="view-dashboard" class="space-y-8 fade-in">
                    <!-- Header Section -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                        <div>
                            <h2 class="text-3xl font-display font-bold text-slate-800">Tableau de Bord</h2>
                            <p class="text-slate-500 mt-1">Aperçu global de l'activité du zoo.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <?php if ($isConnected): ?>
                                <span class="text-xs font-medium text-slate-400 bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-sm flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-zoo-500 animate-pulse"></span> En ligne
                                </span>
                            <?php else: ?>
                                <span class="text-xs font-medium text-slate-400 bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-sm flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Hors ligne
                                </span>

                            <?php endif; ?>
                            <button onclick="openModal()" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-slate-200 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                                <i data-lucide="plus" class="w-4 h-4"></i> Action Rapide
                            </button>
                        </div>
                    </div>

                    <!-- KPI Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- KPI 1 -->
                        <div class="bg-white p-6 rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.04)] border border-slate-100 relative overflow-hidden group hover-lift">
                            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                <i data-lucide="cat" class="w-24 h-24 text-zoo-600 transform rotate-12 translate-x-4 -translate-y-4"></i>
                            </div>
                            <div class="flex flex-col h-full justify-between relative z-10">
                                <div class="w-12 h-12 bg-zoo-50 text-zoo-600 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="cat" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-slate-500 font-medium text-sm">Total Animaux</p>
                                    <h3 class="text-4xl font-display font-bold text-slate-800 mt-1"><?= $total ?></h3>

                                </div>
                            </div>
                        </div>

                        <!-- KPI 2 -->
                        <div class="bg-white p-6 rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.04)] border border-slate-100 relative overflow-hidden group hover-lift">
                            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                <i data-lucide="map" class="w-24 h-24 text-blue-600 transform rotate-12 translate-x-4 -translate-y-4"></i>
                            </div>
                            <div class="flex flex-col h-full justify-between relative z-10">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="map" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-slate-500 font-medium text-sm">Habitats Actifs</p>
                                    <h3 class="text-4xl font-display font-bold text-slate-800 mt-1"><?= $total_hab ?></h3>
                                </div>
                            </div>
                        </div>

                        <!-- KPI 3 -->
                        <div class="bg-white p-6 rounded-3xl shadow-[0_2px_20px_rgba(0,0,0,0.04)] border border-slate-100 relative overflow-hidden group hover-lift">
                            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                <i data-lucide="utensils" class="w-24 h-24 text-amber-600 transform rotate-12 translate-x-4 -translate-y-4"></i>
                            </div>
                            <div class="flex flex-col h-full justify-between relative z-10">
                                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="utensils" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <p class="text-slate-500 font-medium text-sm">Régimes</p>
                                    <h3 class="text-4xl font-display font-bold text-slate-800 mt-1">3</h3>
                                    <div class="flex items-center gap-2 mt-2 text-xs font-medium text-amber-600">
                                        <span class="bg-amber-50 px-2 py-1 rounded-md">Stock Alimentaire OK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Widgets -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Chart 1 -->
                        <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="font-bold text-lg text-slate-800">Répartition par Habitat</h3>
                                <button class="text-slate-400 hover:text-slate-600"><i data-lucide="more-horizontal" class="w-5 h-5"></i></button>
                            </div>
                            <div class="space-y-5">

                                <?php foreach ($habitat as $h) {
                                    global $conn;
                                    $id_habb = $h["id_hab"];
                                    $count_habit = "SELECT COUNT(*) as count FROM animal WHERE habitat_id = " . $id_habb;
                                    $count_query_hab = mysqli_query($conn, $count_habit);
                                    $row_count = mysqli_fetch_assoc($count_query_hab);
                                    $row_count = $row_count["count"];
                                ?>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm font-medium">
                                            <span class="flex items-center gap-2 text-slate-600"><span class="w-3 h-3 rounded-full bg-blue-500"></span> <?= $h["name_hab"] ?></span>
                                            <span class="text-slate-800"><?= $row_count ?></span>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>

                        <!-- Quick Actions / Mini Widget -->
                        <div class="bg-zoo-900 text-white p-6 rounded-3xl shadow-xl shadow-zoo-900/20 relative overflow-hidden flex flex-col justify-between">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-zoo-500 rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>

                            <div class="relative z-10">
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-4 backdrop-blur-sm">
                                    <i data-lucide="sparkles" class="w-5 h-5 text-yellow-300"></i>
                                </div>
                                <h3 class="font-display font-bold text-xl mb-1">Mode Découverte</h3>
                                <p class="text-zoo-200 text-sm leading-relaxed mb-6">Activez le mode jeu pour les enfants sur les tablettes.</p>
                            </div>

                            <button class="w-full bg-white text-zoo-900 py-3 rounded-xl font-bold text-sm hover:bg-zoo-50 transition-colors relative z-10">
                                Lancer l'Application
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ANIMALS VIEW -->
                <div id="view-animals" class="space-y-8 hidden fade-in">
                    <!-- Filters & Controls -->
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-4 justify-between items-center sticky top-0 z-20">
                        <h2 class="text-2xl font-display font-bold text-slate-800 pl-2">Encyclopédie</h2>

                        <div class="flex w-full md:w-auto gap-3">


                            <select id="filter-habitat" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 focus:outline-none focus:ring-2 focus:ring-zoo-500 cursor-pointer">
                                <option value="all">All Animals</option>
                                <?php foreach ($habitat as $h) { ?>
                                    <option value="<?= $h['id_hab'] ?>" <?= (isset($_GET['filter']) && $_GET['filter'] == $h['id_hab']) ? 'selected' : '' ?>><?= $h["name_hab"] ?></option>

                                <?php } ?>
                            </select>

                            <button onclick="openModal()" class="bg-zoo-600 hover:bg-zoo-700 text-white w-10 h-10 rounded-xl flex items-center justify-center shadow-lg shadow-zoo-200 transition-all hover:scale-105">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>


                    <!-- Animal Grid -->
                    <div id="animal-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php while ($row = mysqli_fetch_assoc($query_for_all)) { ?>
                            <div id="<?= $row["id"] ?>" class="bg-white rounded-3xl p-3 shadow-sm border border-slate-100 hover:border-zoo-200 transition-all duration-300 group fade-in hover:-translate-y-1" style="animation-delay: ${index * 50}ms">
                                <div class="relative h-48 rounded-[1.2rem] overflow-hidden mb-3">
                                    <img src="<?= $row["anim_image"] ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="${animal.name}">

                                    <div class="absolute top-2 left-2">
                                        <span class="bg-green-300 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide bg-opacity-90">
                                            <?= $row["type_alimentaire"] ?>
                                        </span>
                                    </div>

                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2 backdrop-blur-[2px]">
                                        <button onclick="openEditModal(<?= $row["id"] ?>)" class="w-9 h-9 bg-white text-slate-700 rounded-full flex items-center justify-center hover:bg-zoo-500 hover:text-white transition-colors shadow-lg transform hover:scale-110">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </button>
                                        <!-- <a href="http://localhost/zoo-Encyclopedie/php/animals.php?id=<?= $row["id"] ?>"> -->
                                        <button onclick="openDeleteModal(<?= $row["id"] ?>)" class="w-9 h-9 bg-white text-slate-700 rounded-full flex items-center justify-center hover:bg-rose-500 hover:text-white transition-colors shadow-lg transform hover:scale-110">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>

                                        </a>
                                    </div>
                                </div>

                                <div class="px-2 pb-2">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-display font-bold text-lg text-slate-800"><?= $row["name_anim"] ?></h3>
                                        <div class="${ds.bg} ${ds.text} p-1.5 rounded-lg">
                                            <i data-lucide="${ds.icon}" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center text-xs text-slate-400 font-medium border-t border-slate-50 pt-2 mt-2">
                                        <span></span>
                                        <span class="group-hover:text-zoo-600 transition-colors"><?= habitat_name($row["habitat_id"]) ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>

                <!-- HABITATS VIEW -->
                <div id="view-habitats" class="space-y-8 hidden fade-in">
                    <div class="flex justify-between items-end">
                        <div>
                            <h2 class="text-3xl font-display font-bold text-slate-800">Zones & Habitats</h2>
                            <p class="text-slate-500 mt-1">Gestion des environnements du zoo.</p>
                        </div>
                        <button class="bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 px-5 py-2.5 rounded-xl font-medium transition-all flex items-center gap-2">
                            <i data-lucide="settings-2" class="w-4 h-4"></i> Configurer
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Habitat Card 1 -->
                        <div class="group relative h-80 rounded-[2rem] overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/30 px-3 py-1 rounded-full text-xs font-bold text-white">
                                5 Espèces
                            </div>

                            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="w-12 h-1 bg-amber-400 mb-4"></div>
                                <h3 class="text-3xl font-display font-bold text-white mb-2">La Savane</h3>
                                <p class="text-slate-200 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                    Plaines arides et chaudes. Zone principale pour les grands mammifères.
                                </p>
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                    <button class="bg-white text-slate-900 px-4 py-2 rounded-lg text-xs font-bold hover:bg-amber-50">Modifier</button>
                                </div>
                            </div>
                        </div>

                        <!-- Habitat Card 2 -->
                        <div class="group relative h-80 rounded-[2rem] overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
                            <img src="https://images.unsplash.com/photo-1535941339077-2dd1c7963098?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/30 px-3 py-1 rounded-full text-xs font-bold text-white">
                                4 Espèces
                            </div>

                            <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="w-12 h-1 bg-zoo-500 mb-4"></div>
                                <h3 class="text-3xl font-display font-bold text-white mb-2">La Jungle</h3>
                                <p class="text-slate-200 text-sm line-clamp-2 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                    Forêt tropicale dense. Zone humide pour les primates et oiseaux.
                                </p>
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                    <button class="bg-white text-slate-900 px-4 py-2 rounded-lg text-xs font-bold hover:bg-zoo-50">Modifier</button>
                                </div>
                            </div>
                        </div>

                        <!-- New Habitat -->
                        <button class="h-80 rounded-[2rem] border-3 border-dashed border-slate-200 hover:border-zoo-400 bg-slate-50 hover:bg-zoo-50 transition-all group flex flex-col items-center justify-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i data-lucide="plus" class="w-8 h-8 text-slate-400 group-hover:text-zoo-600"></i>
                            </div>
                            <span class="font-bold text-slate-400 group-hover:text-zoo-700">Créer une Zone</span>
                        </button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- MODAL OVERLAY -->
    <div id="add-modal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modal-backdrop" onclick="closeModal()"></div>

        <!-- Modal Content -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div id="modal-panel" class="bg-white w-full max-w-lg rounded-3xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300 pointer-events-auto overflow-hidden">

                <!-- Modal Header -->
                <div class="bg-slate-50 px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-display font-bold text-slate-800">Ajouter un Animal</h3>
                        <p class="text-sm text-slate-500">Remplissez les informations de la fiche.</p>
                    </div>
                    <button onclick="closeModal()" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:border-rose-200 transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Form -->
                <form class="p-8 space-y-6" method="POST" action="php/animals.php">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nom de l'animal</label>
                            <input type="text" name="anim_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium focus:ring-2 focus:ring-zoo-500 focus:border-transparent outline-none transition-all placeholder:text-slate-400" placeholder="Ex: Simba le Lion">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Habitat</label>
                                <div class="relative">
                                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium appearance-none outline-none focus:ring-2 focus:ring-zoo-500" name="anim_habit">
                                        <?php
                                        foreach ($habitat as $h) { ?>
                                            <option value="<?= $h["id_hab"] ?>"><?= $h["name_hab"] ?></option>
                                        <?php } ?>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Régime</label>
                                <div class="relative">
                                    <select name="anim_regim" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium appearance-none outline-none focus:ring-2 focus:ring-zoo-500">
                                        <option value="Carnivore">Carnivore</option>
                                        <option value="Herbivore">Herbivore</option>
                                        <option value="Omnivore">Omnivore</option>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Image URL</label>
                            <div class="flex gap-2">
                                <input name="anim_img" type="text" class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm focus:ring-2 focus:ring-zoo-500 outline-none" placeholder="https://...">
                                <button type="button" class="px-4 py-2 bg-slate-100 rounded-xl text-slate-500 hover:text-zoo-600 hover:bg-zoo-50 transition-colors border border-slate-200">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeModal()" class="flex-1 py-3.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all">Annuler</button>
                        <button type="submit" class="flex-1 bg-zoo-600 text-white py-3.5 rounded-xl font-bold hover:bg-zoo-700 shadow-lg shadow-zoo-200 hover:-translate-y-0.5 transition-all">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL OVERLAY: EDIT -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="edit-modal-backdrop" onclick="closeEditModal()"></div>

        <!-- Modal Content -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div id="edit-modal-panel" class="bg-white w-full max-w-lg rounded-3xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300 pointer-events-auto overflow-hidden">

                <!-- Modal Header -->
                <div class="bg-slate-50 px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-display font-bold text-slate-800">Modifier l'Animal</h3>
                        <p class="text-sm text-slate-500">Mettez à jour les informations.</p>
                    </div>
                    <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:border-rose-200 transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Form -->
                <form class="p-8 space-y-6" method="GET" action="php/animals.php">
                    <input type="hidden" id="edit-id">
                    <div class="space-y-4">
                        <input type="text" class="opacity-0" name="id_edit" id="edit_id">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nom de l'animal</label>
                            <input id="anim_nm_edit" type="text" id="edit-name" name="new_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium focus:ring-2 focus:ring-zoo-500 focus:border-transparent outline-none transition-all placeholder:text-slate-400">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Habitat</label>
                                <div class="relative">
                                    <select id="edit-habitat" name="new_habit" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium appearance-none outline-none focus:ring-2 focus:ring-zoo-500">
                                        <?php
                                        foreach ($habitat as $h) { ?>
                                            <option value="<?= $h["id_hab"] ?>"><?= $h["name_hab"] ?></option>
                                        <?php } ?>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Régime</label>
                                <div class="relative">
                                    <select id="edit_diet" name="new_diet" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium appearance-none outline-none focus:ring-2 focus:ring-zoo-500">
                                        <option value="Carnivore">Carnivore</option>
                                        <option value="Herbivore">Herbivore</option>
                                        <option value="Omnivore">Omnivore</option>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Image URL</label>
                            <div class="flex gap-2">
                                <input id="image_anm_edit" type="text" id="edit-img" name="new_img" class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 text-sm focus:ring-2 focus:ring-zoo-500 outline-none">
                                <button type="button" class="px-4 py-2 bg-slate-100 rounded-xl text-slate-500 hover:text-zoo-600 hover:bg-zoo-50 transition-colors border border-slate-200">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeEditModal()" class="flex-1 py-3.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all">Annuler</button>
                        <button type="submit" class="flex-1 bg-zoo-600 text-white py-3.5 rounded-xl font-bold hover:bg-zoo-700 shadow-lg shadow-zoo-200 hover:-translate-y-0.5 transition-all">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL OVERLAY: DELETE -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="delete-modal-backdrop" onclick="closeDeleteModal()"></div>

        <!-- Modal Content -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div id="delete-modal-panel" class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl transform scale-95 opacity-0 transition-all duration-300 pointer-events-auto overflow-hidden">

                <div class="p-8 text-center">
                    <!-- Warning Icon -->
                    <div class="w-16 h-16 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-5 text-rose-500 shadow-sm">
                        <i data-lucide="alert-triangle" class="w-8 h-8"></i>
                    </div>

                    <h3 class="text-2xl font-display font-bold text-slate-800 mb-2">Supprimer ?</h3>
                    <p class="text-slate-500 mb-8 text-sm leading-relaxed">Êtes-vous sûr de vouloir retirer cet animal de l'encyclopédie ? Cette action est irréversible.</p>

                    <div class="flex gap-3">
                        <button onclick="closeDeleteModal()" class="flex-1 py-3.5 rounded-xl font-bold text-slate-600 hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all">
                            Annuler
                        </button>
                        <button id="confirm_delete" class="flex-1 bg-rose-500 text-white py-3.5 rounded-xl font-bold hover:bg-rose-600 shadow-lg shadow-rose-200 hover:-translate-y-0.5 transition-all">
                            Supprimer
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Init Icons
        lucide.createIcons();


        // Navigation Logic
        function switchTab(tab) {
            // Update buttons
            document.querySelectorAll('.nav-item').forEach(el => {
                el.classList.remove('bg-zoo-50', 'text-zoo-600', 'border-zoo-100');
                el.classList.add('text-slate-500', 'border-transparent');
            });

            const activeNav = document.getElementById(`nav-${tab}`);
            if (activeNav) {
                activeNav.classList.remove('text-slate-500', 'border-transparent');
                activeNav.classList.add('bg-zoo-50', 'text-zoo-600', 'border-zoo-100');
            }

            // Update Views
            ['dashboard', 'animals', 'habitats', 'schema'].forEach(v => {
                const el = document.getElementById(`view-${v}`);
                if (v === tab) {
                    el.classList.remove('hidden');
                    // Restart animation
                    el.classList.remove('fade-in');
                    void el.offsetWidth;
                    el.classList.add('fade-in');
                } else {
                    el.classList.add('hidden');
                }
            });
        }

        // Modal Logic with Animation
        const modal = document.getElementById('add-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalPanel = document.getElementById('modal-panel');

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalBackdrop.classList.add('opacity-0');
            modalPanel.classList.remove('scale-100', 'opacity-100');
            modalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }


        // edit modal
        const edit_modal_backdrop = document.getElementById("edit-modal-backdrop");
        const editmodalpanel = document.getElementById("edit-modal-panel");
        const editmodal = document.getElementById("edit-modal");
        // edit modal info
        const anim_nm_edit = document.getElementById("anim_nm_edit");
        const image_anm_edit = document.getElementById("image_anm_edit");
        const edit_habitat = document.getElementById("edit-habitat");
        const edit_diet = document.getElementById("edit_diet");
        const edit_id = document.getElementById("edit_id");

        function openEditModal(id) {
            // showing modal
            editmodal.classList.remove('hidden');
            setTimeout(() => {
                edit_modal_backdrop.classList.remove('opacity-0');
                editmodalpanel.classList.remove('scale-95', 'opacity-0');
                editmodalpanel.classList.add('scale-100', 'opacity-100');
            }, 10);

            // getting data and show it in input

            fetch(`php/animals.php?data=${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log("get : ", data);
                    anim_nm_edit.value = data.name_anim;
                    image_anm_edit.value = data.anim_image;
                    edit_habitat.value = data.habitat_id;
                    edit_diet.value = data.type_alimentaire;
                    edit_id.value = data.id;

                })
                .catch(error => console.log("eror"));






        }


        function closeEditModal() {
            editmodal.classList.add('hidden');
            setTimeout(() => {
                edit_modal_backdrop.classList.add('opacity-0');
                editmodalpanel.classList.add('scale-95', 'opacity-0');
                editmodalpanel.classList.remove('scale-100', 'opacity-100');
            }, 10);
        }

        // delete modal
        const confirm_delete = document.getElementById("confirm_delete");
        const delete_modal_backdrop = document.getElementById("delete-modal-backdrop");
        const delete_modal = document.getElementById("delete-modal");
        const delete_panel_modal = document.getElementById("delete-modal-panel");

        function openDeleteModal(id) {
            console.log(id);
            delete_modal.classList.remove('hidden');
            setTimeout(() => {
                delete_modal_backdrop.classList.remove('opacity-0');
                delete_panel_modal.classList.remove('scale-95', 'opacity-0');
                delete_panel_modal.classList.add('scale-100', 'opacity-100');
            }, 10);

            confirm_delete.addEventListener("click", function() {
                window.location = `http://localhost/zoo-Encyclopedie/php/animals.php?id=${id}`
            })
        }

        function closeDeleteModal() {
            delete_modal.classList.add('hidden');
            setTimeout(() => {
                delete_modal_backdrop.classList.add('opacity-0');
                delete_panel_modal.classList.add('scale-95', 'opacity-0');
                delete_panel_modal.classList.remove('scale-100', 'opacity-100');
            }, 10);


        }


        const filter_habitat = document.getElementById("filter-habitat");

        filter_habitat.addEventListener("change", function() {
            // AJAX

            //        fetch(`php/animals.php?filter=${filter_habitat.value}`)
            //     .then(response => response.text())
            //     .then(filtered_data =>{
            //         console.log("data is" + filtered_data);
            //     })


            // LINK
            const filter_value = filter_habitat.value;
            if (filter_value != "all") {
                window.location.href = `index.php?filter= ${filter_value}`;
            } else {
                window.location.href = `index.php`;
            }
        })
    </script>
</body>

</html>