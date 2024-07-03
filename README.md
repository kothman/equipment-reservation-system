# Equipment Reservation System
This application offers a convenient way to streamline company employees checking out work equipment.

### The reservation system should
- [ ] Require employees to login using their existing Microsoft KPL email address and password

#### User roles
- [ ] user, approver, admin

#### After a user is authenticated
- [ ] Automatically sync available equipment from Snipe-IT (or some other API)
- [ ] The dashboard should show available equipment to authenticated users

#### Request Form
The request form will allow authenticated users to make equipment reservation requests based on current availability
- [ ] Require date (and optional time) range to be selected (for all at once, or individually modified)
- [ ] Notes textarea
- [ ] Allow searching for equipment by name, category, etc
- [ ] Automatically saved First and Last Name, Email, Phone (if provided)

#### After a request is submitted
- [ ] An approver can view, approve, deny, and requests, or set it as pending more information
- [ ] Reminder emails are sent out XX days before the equipment is needed
- [ ] Equipment that has been requested is unavailable for reservation during the allocated request time