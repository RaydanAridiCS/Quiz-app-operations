-- Users Table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    RegistrationDate DATE DEFAULT (CURRENT_DATE)
);

-- Quizzes Table
CREATE TABLE Quizzes (
    QuizID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255) NOT NULL,
    Description TEXT,
    CreatedBy INT,
    CreationDate DATE DEFAULT (CURRENT_DATE),
    IsPublished BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (CreatedBy) REFERENCES Users(UserID)
);

-- Questions Table
CREATE TABLE Questions (
    QuestionID INT PRIMARY KEY AUTO_INCREMENT,
    QuizID INT, 
    QuestionText TEXT NOT NULL,
    QuestionType VARCHAR(50) NOT NULL, 
    FOREIGN KEY (QuizID) REFERENCES Quizzes(QuizID)
);

-- Options Table (For multiple-choice questions)
CREATE TABLE Options (
    OptionID INT PRIMARY KEY AUTO_INCREMENT,
    QuestionID INT, 
    OptionText VARCHAR(255) NOT NULL,
    IsCorrect BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (QuestionID) REFERENCES Questions(QuestionID)
);

-- Scores Table
CREATE TABLE Scores (
    ScoreID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT, 
    QuizID INT, 
    Score DECIMAL(5, 2) NOT NULL,
    DateTaken DATE DEFAULT (CURRENT_DATE),
    TimeTaken INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (QuizID) REFERENCES Quizzes(QuizID)
);