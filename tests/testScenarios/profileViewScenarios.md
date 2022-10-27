##### FEATURE 
Any user's first name or last name on the homepage or in the comments can be clicked by the logged in user and routes to the profile of the clicked user, displaying some basic info about the clicked user.

**SCENARIO 1GWT**
GIVEN
homepage with previous posts is displayed to the logged in user with confirm counts, comment counts and comment sections.
WHEN
logged in user can click on first/last names of annoucement owners and comment owners as well as his/her own name.
THEN
logged in user is routed to the profile page of the clicked user, accessing some basic info about that user.

**SCENARIO 1AAA**
ARRANGE
homepage with previous posts (annoucements) is displayed to the authenticated user with confirm counts, comment counts and comment sections.
ACT
authenticated user can access first/last names of annoucement owners and comment owners as well as his/her own name.
ASSERT
authenticated user is routed to the profile page of the accessed user, accessing some basic info about that user from the DB.

**SCENARIO 2GWT**
GIVEN
homepage with previous posts is displayed to the logged in user with confirm counts, comment counts and comment sections.
WHEN
logged in user can click on first/last names of annoucement owners and comment owners.
THEN
logged in user is routed to a page, displaying "User closed", if the user is deactived in the user DB.

**SCENARIO 2AAA**
ARRANGE
homepage with previous posts (annoucements) is displayed to the authenticated user with confirm counts, comment counts and comment sections.
ACT
authenticated user can access first/last names of annoucement owners and comment owners.
ASSERT
authenticated user is routed to a page, displaying "User closed", if the user is deactived in the user DB.