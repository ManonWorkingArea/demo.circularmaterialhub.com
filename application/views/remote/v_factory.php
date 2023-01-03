<div class="page-content">
    <div class="card card-full-left card-style">
        <div class="content">
            <?php
            $order = $data["factory"]["Paging"]['order'];
            foreach ($data["factory"]['table'] as $factory)
            {
                $order++;
                if($factory['factory_first_app']=="yes"){
                $first = "<span class='badge badge-success badge-pill'><i class='fa fa-check'></i> ครั้งแรก</span>";
                }
                else {
                $first = "";
                }
                echo 
                "<div class='d-flex'>
                    <div>
                        <p class='color-highlight font-600 mb-n1'>{$factory['factory_type']}</p>
                        <h2>{$factory['factory_name']}</h2>
                        <p class='mt-1 mb-1'>{$factory['factory_regcode']} {$factory['factory_code']}</p>
                        <a href='remote/factory/detail/{$factory['factory_id']}' class='btn btn-sm rounded-s font-13 font-600 gradient-highlight'>ดูข้อมูล</a>
                    </div>
                </div>
                <div class='divider mt-2'></div>";
            }
            ?>
        </div>
    </div>
    <?php echo $data["factory"]["Paging"]['display'];?>
</div>