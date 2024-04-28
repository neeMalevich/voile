<script>
    $(document).ready(function () {

        const customSelect = document.querySelector('.custom-select');
        const selectedValue = document.querySelector('.selected-value');
        const selectDropdown = document.getElementById('select-dropdown');

        let selectedOptions = {
            "material": [],
            "color": [],
            "size": [],
            'price_min': '0',
            'price_max': '9999999',
            'category': "<?= $_GET['cat']; ?>",
            "sort": ''
        };

        $(".accordion-price_input").on("change", function () {
            let priceMin = $("input[name='price_min']").val();
            let priceMax = $("input[name='price_max']").val();

            // Проверка и присвоение значения по умолчанию
            priceMin = priceMin !== '' ? parseFloat(priceMin) : 0;
            priceMax = priceMax !== '' ? parseFloat(priceMax) : 9999;

            // Проверка и корректировка значений priceMin и priceMax
            if (priceMin > priceMax) {
                const temp = priceMin;
                priceMin = priceMax;
                priceMax = temp;

                // Отображение значений в элементах <input>
                $("input[name='price_min']").val(priceMin);
                $("input[name='price_max']").val(priceMax);
            }

            selectedOptions['price_min'] = priceMin;
            selectedOptions['price_max'] = priceMax;

            console.log(selectedOptions);

            updateData(selectedOptions);
        });

        $(".accordion input[type='checkbox']").on("change", function () {
            let optionType = $(this).attr("name").split("_")[0];
            let optionId = $(this).attr("id").split("_")[1];

            if ($(this).is(":checked")) {
                selectedOptions[optionType].push(optionId);
            } else {
                let index = selectedOptions[optionType].indexOf(optionId);
                if (index !== -1) {
                    selectedOptions[optionType].splice(index, 1);
                }
            }

            updateData(selectedOptions);
        });

        $(".btn-form--reset").on("click", function () {
            // Сброс данных
            selectedOptions = {
                "material": [],
                "color": [],
                "size": [],
                'price_min': '',
                'price_max': '',
                'category': "<?= $_GET['cat']; ?>",
                "sort": '',
            };

            // Очистка значений в элементах <input>
            $("input[name='price_min']").val('');
            $("input[name='price_max']").val('');

            // Сброс состояния чекбоксов
            $(".accordion input[type='checkbox']").prop("checked", false);

            updateData(selectedOptions);
        });

        function handleOptionClick(e) {
            if (e.target.tagName === 'LABEL') {
                const textContent = e.target.textContent.trim();
                selectedValue.textContent = textContent;
                customSelect.classList.remove('active');

                const name = e.target.previousElementSibling.getAttribute('name');
                selectedOptions['sort'] = name;

                updateData(selectedOptions);
            }
        }

        customSelect.addEventListener('click', function() {
            customSelect.classList.toggle('active');
        });

        selectDropdown.addEventListener('click', handleOptionClick);

        function updateData(dataObject) {
            console.log(dataObject);

            $.ajax({
                url: '/vendor/category/filter-ajax.php',
                method: 'POST',
                data: {
                    material: dataObject.material,
                    color: dataObject.color,
                    size: dataObject.size,
                    price_max: dataObject.price_max,
                    price_min: dataObject.price_min,
                    category: dataObject.category,
                    sort: dataObject.sort,

                },
                success: function (response) {
                    $('.catalog__inner').html(response);
                },
            });
        }

    });
</script>
