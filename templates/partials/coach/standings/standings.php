<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    League Standings
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
                                <th class="width-10">Pos</th>
                                <th>Team</th>
                                <th>Wins</th>
                                <th>Losses</th>
                                <th>Winning Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                                ['pos' => '1', 'team' => 'Team A', 'wins' => '13', 'losses' => '1'],
                                ['pos' => '2', 'team' => 'Team B', 'wins' => '10', 'losses' => '3'],
                                ['pos' => '3', 'team' => 'Team C', 'wins' => '7', 'losses' => '4'],
                                ['pos' => '4', 'team' => 'Team D', 'wins' => '3', 'losses' => '8'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['pos']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['team']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['wins']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['losses']) . '</td>';
                                echo '<td>' . htmlspecialchars(number_format($game['wins'] / ($game['wins'] + $game['losses']), 3)) . '</td>';
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