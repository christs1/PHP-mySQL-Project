<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Season Schedule <span class="fw-300"><i>Upcoming Games</i></span>
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
                                <th class="width-10">Date</th>
                                <th>Home</th>
                                <th>Away</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                                ['date' => '4/28/2025', 'home' => 'Team A', 'away' => 'Team A'],
                                ['date' => '5/05/2025', 'home' => 'Team B', 'away' => 'Team A', 'result' => 'TBD', 'location' => 'Away'],
                                ['date' => '5/12/2025', 'home' => 'Team C', 'away' => 'Team A', 'result' => 'TBD', 'location' => 'Home'],
                                ['date' => '5/19/2025', 'home' => 'Team D', 'away' => 'Team A', 'result' => 'TBD', 'location' => 'Away'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['date']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['home']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['away']) . '</td>';
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

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Season Schedule <span class="fw-300"><i>Past Games</i></span>
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
                                <th class="width-10">Date</th>
                                <th>Home</th>
                                <th>Away</th>
                                <th>Home Score</th>
                                <th>Away Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                                ['date' => '2/28/2025', 'home' => 'Team E', 'away' => 'Team E', 'home_score' => '20', 'away_score' => '21'],
                                ['date' => '3/05/2025', 'home' => 'Team F', 'away' => 'Team E', 'home_score' => '20', 'away_score' => '21'],
                                ['date' => '3/12/2025', 'home' => 'Team G', 'away' => 'Team E', 'home_score' => '15', 'away_score' => '34'],
                                ['date' => '3/19/2025', 'home' => 'Team H', 'away' => 'Team E', 'home_score' => '30', 'away_score' => '21'],
                            ];

                            foreach ($games as $game) {
                              echo '<tr>';
                              echo '<td>' . htmlspecialchars($game['date']) . '</td>';
                              echo '<td>' . htmlspecialchars($game['home']) . '</td>';
                              echo '<td>' . htmlspecialchars($game['away']) . '</td>';
                              echo '<td>' . htmlspecialchars($game['home_score']) . '</td>';
                              echo '<td>' . htmlspecialchars($game['away_score']) . '</td>';
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