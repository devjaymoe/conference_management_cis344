TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `check_room_capacity` BEFORE INSERT ON `sessionattendees` FOR EACH ROW BEGIN\n    DECLARE current_count INT;\n    DECLARE room_capacity INT;\n\n    -- Count current attendees registered for this session\n    SELECT COUNT(*)\n    INTO current_count\n    FROM sessionattendees\n    WHERE idSessionAttendee = NEW.idSessionAttendee;\n\n    -- Get the room capacity\n    SELECT r.capacity\n    INTO room_capacity\n    FROM conferences c\n    JOIN rooms r ON c.idroom = r.idrooms\n    WHERE c.idConferences = NEW.idSessionAttendee;\n\n    -- Prevent registration if room is full\n    IF current_count >= room_capacity THEN\n        SIGNAL SQLSTATE \'45000\'\n        SET MESSAGE_TEXT = \'Room capacity exceeded\';\n    END IF;\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8_general_ci'
created=1793723176149989
