<?php
// Needs Revision to #27, basic outline added as a starting point.

// Path to JSON file
$dataFile = __DIR__ . "/scouting_data.json";

// Load existing data or create new one if none exist
if (file_exists($dataFile)) {
    $scoutingData = json_decode(file_get_contents($dataFile), true);
    if (!is_array($scoutingData)) {
        $scoutingData = [];
    }
} else {
    $scoutingData = [];
}

// Handle post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entry = $_POST; // Collect values
    $entry['timestamp'] = date('Y-m-d H:i:s');

    $scoutingData[] = $entry;

    file_put_contents($dataFile, json_encode($scoutingData, JSON_PRETTY_PRINT));
    echo "<p>Data Saved</p>"; // Add professional submission page or reload page (could also reload after 5 seconds or something)
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>REEFSCAPE 2025 Scouting Form</title> <!-- Eventually we can make the title depend on the season and run everything off of a match.json file -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <div class="container">
    <h1>REEFSCAPE 2025 Scouting</h1>
    <h2>By Team 2839</h2>
    
    <form id="scoutForm">
      <fieldset>
        <legend>Match & Team Info</legend>
        <label for="scouterName">Your Name</label>
        <input type="text" id="scouterName" required>
        
        <label for="alliance">Alliance (your team)</label>
        <select id="alliance" required>
          <option value="" disabled selected hidden>Your Team Number</option>
          <option value="2839">⚙️ 2839</option>
          <!-- Add more options as needed -->
        </select>
        
        <div class="row">
          <div>
            <label for="teamNumber">Team Scouted</label>
            <input type="text" id="teamNumber" required>
          </div>
          <div>
            <label for="matchNumber">Match #</label>
            <input type="number" id="matchNumber" min="1" required>
          </div>
        </div>
        
        <div class="row">
          <div>
            <label>Position</label>
            <select id="teamPosition" required>
              <option value="" disabled selected>Select Position</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div>
            <label>Alliance Color</label>
            <select id="teamColor" required>
              <option value="" disabled selected>Select Color</option>
              <option value="r">Red</option>
              <option value="b">Blue</option>
            </select>
          </div>
        </div>
      </fieldset>
      
      <fieldset>
        <legend>Autonomous (0-:15)</legend>
        <label>Started In Zone</label>
        <select id="autoStartZone" required>
          <option value="" disabled selected hidden>Select Start Zone</option>
          <option value="reef">Reef Zone</option>
          <option value="coralStation">Coral Station</option>
          <option value="floor">Floor</option>
        </select>

        <label>
          <input type="checkbox" id="autoLeftZone"> Left Starting Line
        </label>

        <label>Coral Scored by Level</label>
        <div class="row">
          <div><label for="autoCoralL1">L1</label><input type="number" id="autoCoralL1" min="0" value="0"></div>
          <div><label for="autoCoralL2">L2</label><input type="number" id="autoCoralL2" min="0" value="0"></div>
          <div><label for="autoCoralL3">L3</label><input type="number" id="autoCoralL3" min="0" value="0"></div>
          <div><label for="autoCoralL4">L4</label><input type="number" id="autoCoralL4" min="0" value="0"></div>
        </div>

        <label>Coral Pickup Source</label>
        <div>
          <label><input type="radio" name="autoCoralPickup" value="station" required> Coral Station</label>
          <label><input type="radio" name="autoCoralPickup" value="floor"> Floor</label>
        </div>

        <label>Algae</label>
        <div class="row">
          <div><label for="autoAlgaeRemoved">Removed From Reef</label><input type="number" id="autoAlgaeRemoved" min="0" value="0"></div>
          <div><label for="autoAlgaeProcessor">Scored in Processor</label><input type="number" id="autoAlgaeProcessor" min="0" value="0"></div>
          <div><label for="autoAlgaeNet">Scored in Net</label><input type="number" id="autoAlgaeNet" min="0" value="0"></div>
        </div>

        <label for="autoMissCoral">Missed Coral Placements</label>
        <input type="number" id="autoMissCoral" min="0" value="0">

        <label for="autoMissAlgae">Missed Algae Attempts</label>
        <input type="number" id="autoMissAlgae" min="0" value="0">
      </fieldset>
      
      <fieldset>
        <legend>Teleoperated (0:15-2:30)</legend>
        <label>Coral Scored by Level</label>
        <div class="row">
          <div><label for="teleopCoralL1">L1</label><input type="number" id="teleopCoralL1" min="0" value="0"></div>
          <div><label for="teleopCoralL2">L2</label><input type="number" id="teleopCoralL2" min="0" value="0"></div>
          <div><label for="teleopCoralL3">L3</label><input type="number" id="teleopCoralL3" min="0" value="0"></div>
          <div><label for="teleopCoralL4">L4</label><input type="number" id="teleopCoralL4" min="0" value="0"></div>
        </div>

        <label>Coral Pickup Source</label>
        <div>
          <label><input type="radio" name="teleopCoralPickup" value="station" required> Coral Station</label>
          <label><input type="radio" name="teleopCoralPickup" value="floor"> Floor</label>
        </div>

        <label>Algae</label>
        <div class="row">
          <div><label for="teleopAlgaeRemoved">Removed from Reef</label><input type="number" id="teleopAlgaeRemoved" min="0" value="0"></div>
          <div><label for="teleopAlgaeProcessor">Scored in Processor</label><input type="number" id="teleopAlgaeProcessor" min="0" value="0"></div>
          <div><label for="teleopAlgaeNet">Scored in Net</label><input type="number" id="teleopAlgaeNet" min="0" value="0"></div>
        </div>

        <label for="teleopMissCoral">Missed Coral Placements</label>
        <input type="number" id="teleopMissCoral" min="0" value="0">

        <label for="teleopMissAlgae">Missed Algae Attempts</label>
        <input type="number" id="teleopMissAlgae" min="0" value="0">
      </fieldset>

      <fieldset>
        <legend>Endgame (last phase)</legend>
        <label>Cage Action</label>
        <select id="endgameCage" required>
          <option value="" disabled selected hidden>Select Action</option>
          <option value="none">None</option>
          <option value="parkedUnderCage">Parked Under Cage</option>
          <option value="attachedToCage">Attached (Shallow/Deep Cage)</option>
        </select>

        <label for="endgameNetExtra">Extra Algae Net Score</label>
        <input type="number" id="endgameNetExtra" min="0" value="0">
      </fieldset>
      
      <fieldset>
        <legend>Bonuses & Fouls / Other</legend>
        <label for="processorAlgaeCount">Processor Algae Count (your alliance)</label>
        <input type="number" id="processorAlgaeCount" min="0" value="0">
        
        <label>
          <input type="checkbox" id="coopConditionMet"> Coopertition Condition Met (2+ algae in each processor)
        </label>
        
        <label for="fouls">Minor Fouls Committed</label>
        <input type="number" id="fouls" min="0" value="0">
        
        <label for="techFouls">Technical Fouls</label>
        <input type="number" id="techFouls" min="0" value="0">
        
        <label>
          <input type="checkbox" id="defendedAgainst"> Was Defended Against
        </label>
        
        <label>
          <input type="checkbox" id="playedDefense"> Played Defense
        </label>
        
        <label>
          <input type="checkbox" id="robotFailure"> Robot Non-functional at Any Time
        </label>
        
        <label for="avgCycleTime">Approx Cycle Time (sec)</label>
        <input type="number" id="avgCycleTime" min="0" step="0.1" value="0">
      </fieldset>
      
      <fieldset>
        <legend>Comments / Notes</legend>
        <label for="comments">Observations, Strategy, etc.</label>
        <textarea id="comments" rows="4" style="width:100%;"></textarea>
      </fieldset>
      
      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
