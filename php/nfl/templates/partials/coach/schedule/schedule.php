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
                                <th>Opponent</th>
                                <th>Result</th>
                                <th class="text-right">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                                ['date' => '4/28/2025', 'opponent' => 'Team A', 'result' => 'TBD', 'location' => 'Home'],
                                ['date' => '5/05/2025', 'opponent' => 'Team B', 'result' => 'TBD', 'location' => 'Away'],
                                ['date' => '5/12/2025', 'opponent' => 'Team C', 'result' => 'TBD', 'location' => 'Home'],
                                ['date' => '5/19/2025', 'opponent' => 'Team D', 'result' => 'TBD', 'location' => 'Away'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['date']) . '</td>';
                                echo '<td><a href="page_projects.html" class="fs-lg text-dark">' . htmlspecialchars($game['opponent']) . '</a></td>';
                                echo '<td>' . htmlspecialchars($game['result']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['location']) . '</td>';
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
                                <th>Opponent</th>
                                <th>Result</th>
                                <th class="text-right">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $games = [
                                ['date' => '2/28/2025', 'opponent' => 'Team E', 'result' => 'Win (30-21)', 'location' => 'Home'],
                                ['date' => '3/05/2025', 'opponent' => 'Team F', 'result' => 'Win (30-21)', 'location' => 'Away'],
                                ['date' => '3/12/2025', 'opponent' => 'Team G', 'result' => 'Lose (15-34)', 'location' => 'Home'],
                                ['date' => '3/19/2025', 'opponent' => 'Team H', 'result' => 'Win (30-21)', 'location' => 'Away'],
                            ];

                            foreach ($games as $game) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($game['date']) . '</td>';
                                echo '<td><a href="page_projects.html" class="fs-lg text-dark">' . htmlspecialchars($game['opponent']) . '</a></td>';
                                echo '<td>' . htmlspecialchars($game['result']) . '</td>';
                                echo '<td>' . htmlspecialchars($game['location']) . '</td>';
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