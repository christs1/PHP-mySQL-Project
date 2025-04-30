<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Receiving Statistics
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
                                <th>Reception</th>
                                <th>Yards</th>
                                <th>Touchdowns</th>
                                <th>Longest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                              ['played' => 16, 'reception' => 85, 'Yards' => 1200, 'touchdowns' => 10, 'longest' => 67],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['played']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['reception']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['Yards']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['touchdowns']) . '</td>';
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