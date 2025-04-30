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
                                <th>Player</th>
                                <th>Team</th>
                                <th>Games Played</th>
                                <th>Pass Yds</th>
                                <th>Completion Percentage</th>
                                <th>Longest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                              ['player' => 'Player 1', 'team' => 'Team A', 'played' => '16', 'pass_yds' => '4500', 'comp_perc' => '67.8', 'longest' => '85'],
                              ['player' => 'Player 2', 'team' => 'Team A', 'played' => '14', 'pass_yds' => '3800', 'comp_perc' => '65.3', 'longest' => '78'],
                              ['player' => 'Player 3', 'team' => 'Team A', 'played' => '15', 'pass_yds' => '4100', 'comp_perc' => '69.2', 'longest' => '80'],
                              ['player' => 'Player 4', 'team' => 'Team A', 'played' => '13', 'pass_yds' => '3200', 'comp_perc' => '62.5', 'longest' => '70'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['player']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['team']) . '</td>';
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