<?php
// Include database connection
require_once 'database.php';

// Fetch choir information
$choir_info = array();
$sql = "SELECT * FROM choir_info LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $choir_info = $result->fetch_assoc();
}

// Fetch songs
$songs = array();
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

// Fetch events
$events = array();
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Blessed Singers Family Choir</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <h1>The Blessed Singers <span>Family Choir</span></h1>
                <p class="tagline">Praising God Through Music</p>
            </div>
            <nav>
                <ul>
                    <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="#songs"><i class="fas fa-music"></i> Our Songs</a></li>
                    <li><a href="#events"><i class="fas fa-calendar-alt"></i> Events</a></li>
                    <li><a href="#contact"><i class="fas fa-map-marker-alt"></i> Location</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-overlay">
            <div class="container">
                <h2>Welcome to The Blessed Singers Family Choir</h2>
                <p class="subtitle">A vibrant gospel music ministry in Rwanda, spreading the message of hope and salvation through inspirational music.</p>
                <a href="#songs" class="btn-hero">Listen to Our Music</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title">About Our Choir</h2>
            <div class="about-content">
                <div class="about-text">
                    <h3>Who We Are</h3>
                    <p><?php echo isset($choir_info['description']) ? $choir_info['description'] : "The Blessed Singers Family Choir is a vibrant gospel music ministry based in Rwanda. We use music to spread the message of hope, love, and salvation through Jesus Christ."; ?></p>
                    
                    <h3>Our Denomination</h3>
                    <p>We are proudly part of the <strong><?php echo isset($choir_info['denomination']) ? $choir_info['denomination'] : "Seventh Day Adventist"; ?></strong> Church, committed to worshipping God and sharing the gospel through music.</p>
                    
                    <div class="mission-vision">
                        <div class="card">
                            <i class="fas fa-bullseye"></i>
                            <h4>Our Mission</h4>
                            <p><?php echo isset($choir_info['mission']) ? $choir_info['mission'] : "To spread the gospel of Jesus Christ through inspirational music and foster spiritual growth among members and listeners."; ?></p>
                        </div>
                        <div class="card">
                            <i class="fas fa-eye"></i>
                            <h4>Our Vision</h4>
                            <p><?php echo isset($choir_info['vision']) ? $choir_info['vision'] : "To become a leading gospel choir in Rwanda that impacts lives through worship music and community outreach."; ?></p>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Choir singing">
                </div>
            </div>
        </div>
    </section>

    <!-- Songs Section -->
    <section id="songs" class="section dark-section">
        <div class="container">
            <h2 class="section-title">Our Music</h2>
            <p class="section-subtitle">Listen to our inspirational songs and worship with us</p>
            
            <div class="songs-grid">
                <?php foreach($songs as $song): ?>
                <div class="song-card">
                    <div class="song-icon">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($song['title']); ?></h3>
                    <p><?php echo isset($song['description']) ? htmlspecialchars($song['description']) : "Inspirational gospel music"; ?></p>
                    <a href="<?php echo htmlspecialchars($song['youtube_link']); ?>" target="_blank" class="btn-song">
                        <i class="fab fa-youtube"></i> Watch on YouTube
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="section">
        <div class="container">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Join us for worship and fellowship</p>
            
            <div class="events-container">
                <?php foreach($events as $event): 
                    $isLive = isset($event['is_live']) ? $event['is_live'] : false;
                    $eventDate = isset($event['event_date']) ? new DateTime($event['event_date']) : null;
                ?>
                <div class="event-card <?php echo $isLive ? 'live-event' : ''; ?>">
                    <?php if($isLive): ?>
                    <div class="live-badge">
                        <i class="fas fa-broadcast-tower"></i> LIVE NOW
                    </div>
                    <?php endif; ?>
                    
                    <div class="event-date">
                        <?php if($eventDate): ?>
                        <span class="date-day"><?php echo $eventDate->format('d'); ?></span>
                        <span class="date-month"><?php echo $eventDate->format('M'); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="event-details">
                        <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                        <p><?php echo isset($event['description']) ? htmlspecialchars($event['description']) : ""; ?></p>
                        
                        <div class="event-info">
                            <?php if(isset($event['event_time'])): ?>
                            <p><i class="far fa-clock"></i> <?php echo date('h:i A', strtotime($event['event_time'])); ?></p>
                            <?php endif; ?>
                            
                            <?php if(isset($event['location'])): ?>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if(isset($event['youtube_link']) && !empty($event['youtube_link'])): ?>
                        <a href="<?php echo htmlspecialchars($event['youtube_link']); ?>" target="_blank" class="btn-event">
                            <?php if($isLive): ?>
                            <i class="fas fa-tv"></i> Join Live Stream
                            <?php else: ?>
                            <i class="fab fa-youtube"></i> Watch Recording
                            <?php endif; ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="contact" class="section dark-section">
        <div class="container">
            <h2 class="section-title">Our Location</h2>
            <div class="location-container">
                <div class="location-info">
                    <h3>Where to Find Us</h3>
                    <p><i class="fas fa-church"></i> <strong>Church:</strong> UNILAK Rwamagana SDA Church</p>
                    <p><i class="fas fa-map"></i> <strong>District:</strong> Rwamagana District</p>
                    <p><i class="fas fa-flag"></i> <strong>Field:</strong> South East Rwanda Field</p>
                    <p><i class="fas fa-globe-africa"></i> <strong>Union:</strong> Rwanda Union Mission</p>
                    
                    <div class="contact-card">
                        <h4><i class="fas fa-info-circle"></i> About Our Church</h4>
                        <p>As Seventh Day Adventists, we observe the Sabbath (Saturday) as our day of worship. Our services include Bible study, prayer meetings, and uplifting music ministry through our choir.</p>
                    </div>
                </div>
                <div class="location-map">
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <h4>Rwamagana, Rwanda</h4>
                        <p>Eastern Province of Rwanda</p>
                        <p>Located approximately 50 km east of Kigali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3>The Blessed Singers Family Choir</h3>
                    <p>Rwamagana SDA Church</p>
                    <p>Seventh Day Adventist</p>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#songs">Our Songs</a></li>
                        <li><a href="#events">Events</a></li>
                        <li><a href="#contact">Location</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Contact Info</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Rwamagana, Rwanda</p>
                    <p><i class="fas fa-church"></i> UNILAK Rwamagana SDA Church</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> The Blessed Singers Family Choir. All rights reserved.</p>
                <p class="visitor-count">
                    <i class="fas fa-users"></i> 
                    <?php 
                    // Get visitor count
                    $sql = "SELECT COUNT(*) as total FROM visitors";
                    $result = $conn->query($sql);
                    if ($result) {
                        $row = $result->fetch_assoc();
                        echo "Website Visitors: " . $row['total'];
                    } else {
                        echo "Praising God Through Music";
                    }
                    ?>
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#home" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Close database connection -->
    <?php $conn->close(); ?>
</body>
</html>