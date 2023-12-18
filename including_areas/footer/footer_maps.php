<script>
    ymaps.ready(init);

    function init() {
        let myMap = new ymaps.Map("map", {
            center: [55.79184402793921, 37.58002233265868],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });

        myMap.geoObjects
            .add(new ymaps.Placemark([55.70632506902841, 37.64540199999998], {
                balloonContent: 'г. Москва, ул. Автозаводская, д. 16, к. 2, стр. 16г.'
            }, {
                preset: 'islands#icon',
                iconColor: '#ff0000'
            }))
            .add(new ymaps.Placemark([55.88032856884945, 37.54732399999993], {
                balloonContent: 'Дмитровское шоссе 98 стр 1'
            }, {
                preset: 'islands#dotIcon',
                iconColor: '#ff0000'
            }));
        myMap.controls.remove('searchControl')
    }
</script>