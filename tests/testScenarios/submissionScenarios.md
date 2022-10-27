##### FEATURE 
Users can make a post (announcement) about returned products on the homepage.

**SCENARIO 1GWT**
GIVEN
homepage is displayed with empty text area in announcement submit form
WHEN
logged in user tries to submit a text body an announcement
THEN
text body is published as the most recent announcement on the homepage


**SCENARIO 1AAA**
ARRANGE
homepage with previous posts is displayed and user can submit text in the submit form
ACT
authenticated user submits text
ASSERT
text is posted and displayed along with previous posts

**SCENARIO 2GWT**
GIVEN
homepage is displayed with empty text area in announcement submit form
WHEN
logged in user tries to submit an empty text body in the text area as an announcement
THEN
no announcement is published on the homepage

**SCENARIO 2AAA**
ARRANGE
homepage with previous posts is displayed and user can submit text in the submit form
ACT
authenticated user submits empty string
ASSERT
empty string is not posted but previous posts are on display