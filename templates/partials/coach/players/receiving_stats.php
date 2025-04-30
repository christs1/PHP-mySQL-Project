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
                                <th>Player</th>
                                <th>Team</th>
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
                              ['player' => 'Player 1', 'team' => 'Team A', 'played' => 16, 'reception' => 85, 'Yards' => 1200, 'touchdowns' => 10, 'longest' => 67],
                              ['player' => 'Player 2', 'team' => 'Team A', 'played' => 14, 'reception' => 78, 'Yards' => 1100, 'touchdowns' => 8, 'longest' => 65],
                              ['player' => 'Player 3', 'team' => 'Team A', 'played' => 15, 'reception' => 80, 'Yards' => 1150, 'touchdowns' => 9, 'longest' => 69],
                              ['player' => 'Player 4', 'team' => 'Team A', 'played' => 13, 'reception' => 70, 'Yards' => 950, 'touchdowns' => 7, 'longest' => 62],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['player']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['team']) . '</td>';
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