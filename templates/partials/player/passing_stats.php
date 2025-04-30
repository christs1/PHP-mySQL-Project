<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Passing Statistics
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                        data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="dt-basic-example" class="table table-bordered table-hover w-100">
                        <thead>
                            <tr>
                                <th>Games Played</th>
                                <th>Pass Yds</th>
                                <th>Completion Percentage</th>
                                <th>Longest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                              ['played' => '16', 'pass_yds' => '4500', 'comp_perc' => '67.8', 'longest' => '85'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['played']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['pass_yds']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['comp_perc']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['longest']) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- datatable end -->
                </div>
            </div>
        </div>
    </div>
</div>