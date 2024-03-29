##### FEATURE 
Authentication system: registration and login of user(s).

**SCENARIO 1GWT**
GIVEN
authentication page is displayed with fields to either sign-in or sign-up.
WHEN
not logged in user tries to access /posts webpage (or any protected one)
THEN
user is redirected to login form

**SCENARIO 1AAA**
ARRANGE
application with access to DB prefilled with single authenticable user
ACT
user tries to access route which is protected
ASSERT
user is redirected to login page AND response body contains string with expected login form html

**SCENARIO 2GWT**
GIVEN
authentication page is displayed with fields to either sign-in or sign-up.
WHEN
user submits login form
THEN
user can see posts

**SCENARIO 2AAA**
ARRANGE
application with access to DB prefilled with single authenticable user and n amount of posts user can see after being authenticated
ACT
user submits login form
ASSERT
user after submitting login form us redirected to page with posts and receives string with html list of posts