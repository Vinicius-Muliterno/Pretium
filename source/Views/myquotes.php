<?php $v->layout("theme"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Minhas cotações</h1>
    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newQuote">+ nova cotação</a>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">ID da Cotação</th>
                <th scope="col">Destinatário</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $count = 0;
            if ($quotes):
                foreach ($quotes as $quote):
                    $count++;
                    ?>
                    <tr>
                        <th scope="row"><?= $count; ?></th>
                        <td class="fw-bold <?= ($quote->status()->name == 'Nova Solicitação' ? 'text-warning' : ''); ?>"><?= $quote->status()->name; ?></td>
                        <td><?= $quote->id; ?></td>
                        <td><?= $quote->provider()->social_reason; ?></td>
                        <td><a class="btn btn-info btn-sm view" data-id="<?= $quote->id; ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                <?php endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $v->start('modal'); ?>
<div class="modal fade" id="newQuote" tabindex="-1" aria-labelledby="newQuoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newQuoteLabel">Nova cotação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= $router->route("app.newQuote"); ?>" method="post">
                <div class="modal-body">
                    <div class="row mb-3">

                        <?php $date = date('Y-m-d'); ?>

                        <div class="col-6">
                            <label for="">Data de abertura</label>
                            <input type="date" class="form-control" value="<?= $date; ?>" disabled>
                        </div>
                        <div class="col-6">
                            <label for="">Data de fechamento</label>
                            <input type="date" class="form-control" name="closure_at"
                                   value="<?= date('Y-m-d', strtotime("+3 day", strtotime($date))); ?>" min="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <label for="providerDataList" class="form-label">Escolha um fornecedor</label>
                    <input class="form-control mb-3" name="provider" list="providerDatalistOptions"
                           id="providerDataList"
                           placeholder="Escreva para pesquisar..." required>
                    <datalist id="providerDatalistOptions">
                        <?php
                        $providers = (new \Source\Models\Provider())->find("id != {$provider_id}")->fetch(true);
                        if ($providers):
                        foreach ($providers

                        as $provider): ?>
                        <option value="<?= $provider->social_reason; ?>">
                            <?php
                            endforeach;
                            endif; ?>
                    </datalist>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary">Enviar cotação</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="viewQuote" tabindex="-1" aria-labelledby="viewQuoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newQuoteLabel">Visualizar cotação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-5x text-warning mt-3 pb-3"></i>
                <h3>Oops...</h3>
                <p>Selecione produtos</p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ok</button>
            </div>
        </div>
    </div>
</div>

<?php $v->stop(); ?>

<?php $v->start('script'); ?>
<script src="<?= asset("js/jquery-3.6.0.min.js"); ?>"></script>
<script>

    var product = [];

    $(document).ready(function () {
        $(document).on("change", "#providerDataList", function () {

            if ($(this).val()) {
                $.post("../source/Ajax/fetchProviderProducts.php", {provider: $(this).val()}, function (data) {

                    $("#newQuote .modal-body").append(data)

                })
            }
        });

        $(document).on("change", "#providerDataList2", function () {
            if ($(this).val()) {

                $.ajax({
                    type: "POST",
                    url: "../source/Ajax/fetchProviderProduct.php",
                    data: {provider: $("#providerDataList").val(), product_name: $(this).val()},
                    dataType: "json",
                    success: function (data) {

                        $("#tableProductsNewQuote tbody").append('<tr><th scope=\'row\'>#</th><td class=\'description\'\'>' + data.product_name + '</td><td>' + data.brand + '</td><td><input class=\'w-auto form-control form-control-sm unity\' type=\"number\" value=\"1\"></td><td><span class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></span></tr></tr>');

                        product.push([data.product_name, 1]);

                        $("#providerDatalistOptions2").find("option[value='" + data.product_name + "']").val('');
                        $("#providerDataList2").val('');
                    }
                });
            }
        });


        $(document).on("change", ".unity", function () {
            for (var i = product.length - 1; i >= 0; i--) {
                if (product[i][0] === $(this).closest('tr').find('.description').text()) {
                    product[i][1] = $(this).val();
                }
            }
        });

        $(document).on("click", ".delete", function () {
            $('#providerDatalistOptions2').append('<option value=\'' + $(this).closest('tr').find('.description').text() + '\'>' + $(this).closest('tr').find('.description').text() + '</option>');

            for (var i = product.length - 1; i >= 0; i--) {
                if (product[i][0] === $(this).closest('tr').find('.description').text()) {
                    product.splice(i, 1);
                }
            }

            $(this).closest('tr').remove();
        });

        $(document).on("click", ".view", function () {
            $.ajax({
                url: "../source/Ajax/fetchQuote.php",
                data: {id:$(this).data("id")},
                type: "post",
                success: function (data) {
                    $("#viewQuote").modal('show');
                    $("#viewQuote .modal-body").html(data);
                }
            });
        });

        $("form").submit(function (e) {

            e.preventDefault();

            var form = $(this);
            var action = form.attr("action");
            var data = form.serialize();

            if (product.length === 0) {
                $('#messageModal').modal('show');
                return;
            }

            $.ajax({
                url: action,
                data: {data, product},
                type: "post",
                success: function () {
                    location.reload();
                }
            });
        });
    });
</script>
<?php $v->stop(); ?>
