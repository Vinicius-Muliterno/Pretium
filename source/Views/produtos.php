<?php
$v->layout("theme");

use Source\Models\Products;
use CoffeeCode\Paginator\Paginator;

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);
$products = new Products();
$paginator = new Paginator("http://localhost/new-pretium/app/produtos?page=");
$paginator->pager($products->find("provider_id=:provider_id", "provider_id=$provider_id")->count(), 10, $page);

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produtos</h1>
        <a class="btn btn-success" id="addProductModal"><i class="fas fa-plus"></i> Adicionar</a>
    </div>

    <div class="row">
        <div class="d-flex justify-content-end">
            <div class="input-group mb-3 w-25">
                <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar"
                       aria-describedby="button-addon2">
                <button class="btn bg-white border-end border-bottom border-top" type="button" id="button-addon2"><i
                            class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="tableProducts" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Código</th>
                    <th scope="col">Unidade de medida</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $productsTable = $products->find("provider_id=:provider_id",
                    "provider_id=$provider_id")->limit($paginator->offset())->offset($paginator->limit())->fetch(true);
                if ($productsTable) {

                    $count = 0;
                    foreach ($productsTable as $product) {
                        $count++;
                        echo "<tr>";
                        echo "<th scope='row'>" . ($paginator->offset() + $count) . "</th>";
                        echo "<td class='w-50'>$product->product_name</td>";
                        echo "<td>$product->brand</td>";
                        echo "<td>$product->code</td>";
                        echo "<td>{$product->measurementUnit()->unity} ({$product->measurementUnit()->symbol})</td>";
                        echo "<td><a id='editProductModal' class='btn btn-warning btn-sm me-2' data-id='$product->id'><i class='fas fa-pen text-white'></i></a><a  class='deleteProduct btn btn-danger btn-sm' data-id='$product->id' data-bs-toggle='modal' data-bs-target='#productDeleteModal'><i class='fas fa-trash''></i></a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <?= "<p>Página {$paginator->page()} de {$paginator->pages()}</p>"; ?>
            <?= $paginator->render("paginator"); ?>
        </div>
    </div>

<?php $v->start('modal'); ?>
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= $router->route("app.product"); ?>" method="post">
                    <div class="modal-body">
                        <input type="text" name="id" id="id" hidden>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputDescription"
                                   name="description" placeholder="Descrição do produto">
                            <label for="floatingInputDescription">Descrição do produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputBrand"
                                   name="brand" placeholder="Marca do produto">
                            <label for="floatingInputBrand">Marca do produto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputCode"
                                   name="code" placeholder="Código do produto">
                            <label for="floatingInputCode">Código do produto</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" name="measurementUnit" id="floatingSelectMeasurementUnit"
                                    aria-label="Floating label select example">
                                <?php

                                $measurementUnits = (new \Source\Models\MeasurementUnits())->find()->fetch(true);
                                if ($measurementUnits) {
                                    foreach ($measurementUnits as $measurementUnit) {
                                        echo "<option value='$measurementUnit->id'>$measurementUnit->unity ($measurementUnit->symbol)</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="floatingSelectMeasurementUnit">Unidade de medida</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button class="btn btn-success" id="productModalButton"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="productDeleteModal" tabindex="-1" aria-labelledby="productDeleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDeleteModalLabel">Deletar produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja deletar este produto?</p>
                </div>
                <div class="modal-footer">

                    <button id="buttonDelete" type="button"
                            class="btn btn-lg btn-link text-danger fs-6 text-decoration-none col-12 m-0 rounded-0 border-right">
                        <strong>Deletar</strong></button>
                </div>
            </div>
        </div>
    </div>
<?php $v->stop(); ?>

<?php $v->start('script'); ?>
    <script>
        $(document).ready(function () {


            $('.modal').on('hidden.bs.modal', function () {

                $(this).find('form').trigger('reset');
            });

            $("#addProductModal").click(function () {
                $("#productModal").modal('show');
                $("#productModal #productModalLabel").text('Adicionar produto');
                $("#productModal #productModalButton").text('Adicionar');
            });


            $(document).on("click", "#editProductModal", function () {
                var id = $(this).data("id");
                $.ajax({
                    type: "POST",
                    url: "../source/Ajax/fetchProduct.php",
                    data: {id: id},
                    dataType: "json",
                    success: function (data) {
                        $("#productModal").modal('show');
                        $("#productModal #productModalLabel").text('Editar produto');
                        $("#productModal #productModalButton").text('Editar');
                        $("#productModal #floatingInputDescription").val(data.product_name);
                        $("#productModal #floatingInputBrand").val(data.brand);
                        $("#productModal #floatingInputCode").val(data.code);
                        $("#productModal #id").val(id);
                        $("#productModal #floatingSelectMeasurementUnit").val(data.measurement_unit);
                    }
                });
            });


            $(document).on("click", ".deleteProduct", function () {
                $("#buttonDelete").data("id", $(this).data("id"));
            });

            $(document).on("click", "#buttonDelete", function () {
                $.ajax({
                    type: "POST",
                    url: "../source/Ajax/deleteProduct.php",
                    data: {id: $("#buttonDelete").data("id")},
                    success: function () {
                        location.reload();
                    },
                });
            });
        });
    </script>
<?php $v->stop(); ?>