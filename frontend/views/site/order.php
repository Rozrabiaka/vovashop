<?php
/* @var $ordernumber frontend\controllers\SiteController */
?>

<!-- Single Product Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="your-order-area border">

                    <!-- Title Start -->
                    <h3 class="title">Спасибо за покупку в нашем магазине!</h3>
                    <!-- Title End -->

                    <!-- Your Order Table Start -->
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <!-- Table Footer Start -->
                            <tfoot>
                            <tr class="order-total">
                                <th class="text-start ps-0">Номер заказа</th>
                                <td class="text-end pe-0"><strong><span class="amount"><?php echo $ordernumber ?></span></strong>
                                </td>
                            </tr>
                            </tfoot>
                            <!-- Table Footer End -->

                        </table>
                    </div>
                    <!-- Your Order Table End -->
                </div>

                <p>Если у вас возникли вопросы, пожалуйста позвоните нам +380688071420</p>
            </div>
        </div>
    </div>
    <!-- Single Product Section End -->
</div>