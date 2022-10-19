##### FEATURE 
Other users (customer service users) can make a comment about the returned product, such as "refund initiated".

**SCENARIO 1GWT**
GIVEN
under each previous post on the page, logged in user can submit a comment
WHEN
logged in user submits a text as a comment
THEN
submitted text is displayed in the comment section

**SCENARIO 1AAA**
ARRANGE
homepage with previous posts are displayed. Under each previous post on the homepage, authenticated user can submit text as a comment
ACT
authenticated user submits a text into the form as a comment
ASSERT
submitted text is displayed in the comment section

**SCENARIO 2GWT**
GIVEN
homepage with previous posts are displayed.
WHEN
logged in user views each previous post on the homepage
THEN
previous comments under each viewed post are displayed if they exist

**SCENARIO 2AAA**
ARRANGE
homepage with previous posts are displayed for authenticated user
ACT
authenticated user views all previous posts
ASSERT
previous comments under each view post are displayed if they are not empty