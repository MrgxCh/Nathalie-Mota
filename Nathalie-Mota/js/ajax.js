let loading = false; 
const $loadMoreButton = $('#load-more'); //Bouton de chargement
const $container = $('.gallerie'); //Container des articles

$loadMoreButton.on('click', function () {
    get_more_posts(true); // Obtient plus d'articles quand bouton cliqué
});

//Fonction pour charger plus d'articles
function get_more_posts(load) {
    let inputPage = $('input[name="page"]');
    let page = parseInt(inputPage.val());
    page = load ? page + 1 : 1; 
    const category = $('select[name="category-filter"]').val(); 
    const format = $('select[name="format-filter"]').val();
    const dateSort = $('select[name="date-sort"]').val();

    console.log(category, format, dateSort, page);

    $.ajax({
        type: 'GET',
        url: wp_data.ajax_url, // Défini dans functions.php
        data: {
            action: 'load_more_posts',
            page,
            category,
            format,
            dateSort
        },
        success: function (response) {
            if (response.success) {
                if (load) {
                    $container.append(response.data); // Ajoute le 'response' au container
                } else {
                    $container.html(response.data); // Affiche les nouveaux articles
                }
                $loadMoreButton.text('Charger plus'); 
                inputPage.val(page); 
                loading = false; 
            } else {
                if (load) {
                    $loadMoreButton.text('Fin des publications'); 
                } else {
                    let txt = '<p>Aucun résultat ne correspond aux filtres de recherche.<br>';
                    $container.html(txt); 
                }
            }
        },
        error: function () {
            console.log('Error loading more posts.');
            loading = false; //Charge de nouveau si erreur
            $loadMoreButton.text('Charger plus'); 
        }
    });

    if (!loading) {
        loading = true;
        $loadMoreButton.text('Chargement en cours...'); 
    }
}

/*Filtres*/
function recursive_change(selectId) {
    $('#' + selectId).change(function () {
        get_more_posts(false); 
    });
}

if ($('#category-filter').length) {
    recursive_change('category-filter'); 
}

if ($('#format-filter').length) {
    recursive_change('format-filter');
}

if ($('#date-sort').length) {
    recursive_change('date-sort'); 
}
