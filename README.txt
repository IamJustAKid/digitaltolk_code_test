How is the code?
- Terrible
- God Classes
- Code is not clean
- Booking Repository is filled with logic and too many methods
- No Comments or Clear way to understand about the methods
- No Criterias to properly use Repository Pattern
- Mixed Use of Repository and Direct Model Calling
- No Use of separate Mailer classes
- Bad Use of Push Notifications Logic (Code duplication)
- So much code is duplicated

What would I do?
- Empty Booking Repository
- Transfer every method to Single Action Classes
- Add Criteria capability to Repository Base Class to Filter database easily
- Call Single Action Classes in BookingController Methods as per request states
- Comment Controller functions OR rename them to clearly explain what they do
- Use Proper Mailer classes and instead of using fixed admin email address add a database entry
- Push Notifications should have a generic Class
  - that class should be called everywhere
- To avoid code duplication, I would break it into many pieces and Call those pieces wherever I need to clean the code.
- Use of accessors to easily take care some of obvious things in business logic.

- Other than this, I would split code into separate directories. Each Database Table will have Directory in each major components.
  i.e. Actions -> Jobs -> CreateJob, UpdateJob
  Repository -> Criteria -> Job -> All Job related Criterias
  Similarly with Emails, Notifications, Views etc.
- I also Divide my project into Modules. Laravel major app folders remains empty.
  -> Modules directly has Base, Core, HR etc. modules
  -> Each module directory has Actions, Http folder with controllers, request, database with migrations and seeders, etc.

This is how I do my current projects. Samples can be provided in a live meeting.
I only require tests when the code is like in this project. Where Business logic is scattered across the whole application. Clean code and properly linked code
rarely needs tests to run everytime. Currently, I am not using any tests in my ongoing projects, as it is a small team, and code goes in one direction. Code is reused
to avoid conflicts. But I can focus on those I get selected and I need tests. I can definitely write those.