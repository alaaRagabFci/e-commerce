<script src="{{ asset('/assets/js/app.js')}}"></script>
<script>
    (function () {
        const classname = document.querySelectorAll(".quantity");

        Array.from(classname).forEach(function (element) {
            element.addEventListener("change", function () {
                const id = element.getAttribute("data-id");
                const productQuantity = element.getAttribute(
                    "data-productQuantity"
                );

                axios
                    .patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity,
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = "cart.html";
                    })
                    .catch(function (error) {
                        // console.log(error);
                        window.location.href = "cart.html";
                    });
            });
        });
    })();
</script>

<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="../cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="../cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('/assets/js/algolia.js')}}"></script>
