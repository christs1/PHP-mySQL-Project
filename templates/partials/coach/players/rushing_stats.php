<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Rushing Statistics
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
                                <th>Attempts</th>
                                <th>Yards</th>
                                <th>Touchdowns</th>
                                <th>Fumbles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                              ['player' => 'Player 1', 'team' => 'Team A', 'played' => 16, 'attempts' => 4500, 'Yards' => 67.8, 'touchdowns' => 85, 'fumbles' => 3],
                              ['player' => 'Player 2', 'team' => 'Team A', 'played' => 14, 'attempts' => 3800, 'Yards' => 65.3, 'touchdowns' => 78, 'fumbles' => 7],
                              ['player' => 'Player 3', 'team' => 'Team A', 'played' => 15, 'attempts' => 4100, 'Yards' => 69.2, 'touchdowns' => 80, 'fumbles' => 1],
                              ['player' => 'Player 4', 'team' => 'Team A', 'played' => 13, 'attempts' => 3200, 'Yards' => 62.5, 'touchdowns' => 70, 'fumbles' => 13],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['player']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['team']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['played']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['attempts']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['Yards']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['touchdowns']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['fumbles']) . '</td>';
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