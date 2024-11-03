# Ticket Reservation System

This project is developed for the **CS438** course and focuses on implementing a ticket reservation system with core functionalities to manage and interact with events. The system includes essential features to handle ticket reservations, cancellations, event searches, and event management through an admin dashboard.

## Functional Requirements

The project includes the following four main functional requirements:

1. **Ticket Reservation**  
   Users can reserve tickets for available events through the system. The ticket reservation process includes selecting an event, specifying the number of tickets, and completing the booking. This ensures that users can easily secure their spots for desired events.

2. **Ticket Cancellation**  
   Users have the option to cancel their ticket reservations if they can no longer attend an event. The cancellation process allows users to release reserved tickets, updating availability in the system accordingly.

3. **Event Search**  
   Users can search for specific events based on various criteria (e.g., event name, date, or location). This feature enables users to quickly find and view details of events they are interested in, enhancing the user experience.

4. **Admin Dashboard for Event Management**  
   The system includes an admin dashboard, allowing administrators to manage events effectively. Admins can create, update, or delete events, as well as monitor reservations. This feature provides full control over event management, ensuring smooth operation and event availability.

## Technologies Used
- **Laravel** for the backend framework.
- **Sqlite** for database management.
- **HTML/CSS** and **Tailwind CSS** for frontend styling.
- **JavaScript** for enhanced interactivity.

## Project Structure

1. **views/auth/signin.blade.php**  
   - This file contains the layout for the **Sign In** page, where users can enter their credentials (email and password) to access the system. It includes a form and user interface elements for signing in.

2. **views/events/**  
   - This folder contains files related to **event management**. It likely includes templates for displaying event details, listing available events, and possibly creating or editing events.

3. **views/about.blade.php**  
   - This file represents the **About** page, which typically provides information about the system, such as the purpose of the project, its objectives, and details about the developers or organization.

4. **views/home.blade.php**  
   - The **Home** page template, which serves as the main landing page for the system. This page may include featured events, quick links to various sections, or general information about the application.

5. **views/myTickets.blade.php**  
   - This file provides a view for **My Tickets**, where users can see the tickets they have reserved. It may also include options for users to manage their reservations, like viewing ticket details or canceling tickets.

6. **routes/console.php**  
   - This file registers custom **commands** for the Laravel application that can be executed via the command line. It’s useful for adding maintenance tasks or other automated processes within the system.

7. **routes/web.php**  
   - The primary **web routing** file for the application, where routes for web requests are defined. It directs HTTP requests to the appropriate controllers based on the URL, ensuring that users are routed correctly to the desired pages.

This structure organizes the project’s templates and routing logic, making it easy to manage and navigate through the different sections of the Ticket Reservation System.
