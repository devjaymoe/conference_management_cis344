<?php

class Conference
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // public function addComment($username, $comment_body)
    // {
    //     $sql = "INSERT INTO comments (user_name, comment_body) VALUES (?,?)";
    //     $stmt = $this->conn->prepare($sql);
    //     // in order to avoid sql injections you are going to use preferreed statements
    //     // that when when ppl but data into the database it will not trigger sql
    //     $stmt->bind_param("ss", $username, $comment_body);
    //     $stmt->execute();
    // }

    public function getRooms()
    {
        // make sql query
        $sql = "SELECT * FROM rooms";

        // make query and get results
        $result = $this->conn->query($sql);
        // fetch results in an array 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getConferences()
    {
        // query for all conferences
        // $sql = "SELECT * FROM conferences ORDER BY idConferences DESC";

        // make sql query
        $sql = "SELECT
                        c.idConferences,
                        c.Name AS Conference_Name,
                        c.Description,
                        c.Date AS Conference_Date,
                        c.Price,
                        r.RoomNumber AS Room_Number,
                        r.Capacity
                    FROM conferences c
                    JOIN rooms r
                    ON c.idroom = r.idrooms";

        // make query and get results
        $result = $this->conn->query($sql);
        // fetch results in an array 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSessionSpeakers($idConference)
    {
        // make sql query
        $sql = "SELECT
                        c.idConferences,
                        c.Name AS Conference_Name,
                        c.Description,
                        c.Date AS Conference_Date,
                        r.RoomNumber AS Room_Number,
                        r.Capacity,
                        s.ExpertiseArea,
                        u.Name
                    FROM conferences c
                    JOIN rooms r ON c.idroom = r.idrooms
                    JOIN sessionspeaker ss ON c.idConferences = ss.idSessionSpeaker
                    JOIN speakers s ON ss.idSpeaker = s.idSpeakers
                    JOIN users u ON s.idUser = u.idUsers
                    WHERE idConferences = $idConference";

        // make query and get results
        $result = $this->conn->query($sql);
        // fetch results in an array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSessionAttendees($idConference)
    {
        // make sql query
        $sql = "SELECT
                        c.idConferences,
                        c.Name AS Conference_Name,
                        c.Description,
                        c.Date AS Conference_Date,
                        r.RoomNumber AS Room_Number,
                        r.Capacity,
                        u.Name
                    FROM conferences c
                    JOIN rooms r ON c.idroom = r.idrooms
                    JOIN sessionattendees sa ON c.idConferences = sa.idSessionAttendee
                    JOIN attendees a ON sa.idAttendee = a.idAttendees
                    JOIN users u ON a.idUser = u.idUsers
                    WHERE idConferences = $idConference";

        // make query and get results
        $result = $this->conn->query($sql);
        // fetch results in an array
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
