##### FEATURE 
Users have the option to logout. There they can log in again either with the same account or another account.

**SCENARIO 1GWT**
GIVEN
homepage with previous posts is displayed with the header bar or profile page of any user is on display with the header bar
WHEN
logged in user clicks on "log out" on the right corner or the header
THEN
user is logged out and is routed to the authentication page with no access to view posts or submit posts

**SCENARIO 1AAA**
ARRANGE
homepage with previous posts is displayed with the header bar or profile page of any user is on display with the header bar
ACT
authenticated user clicks on "log out" on the right corner or the header
ASSERT
user is logged out and is routed to the authentication page with no access to view posts or submit posts