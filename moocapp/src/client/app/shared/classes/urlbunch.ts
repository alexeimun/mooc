export class urlBunch {
  //Url Parameters
  //private static hostname = `http://academicmooc.tk/mooc`;
  private static hostname = `http://localhost/mooc`;
  public static urls = {
    //User available urls
    user : {
      user : `${urlBunch.hostname}/users`, //Common verbs like get, post, put and delete
      valuser : `${urlBunch.hostname}/users/validateuser`, // Validates username
      userlogin : `${urlBunch.hostname}/users/userlogin`, //Login a user
    },
    course : {
      "courses" : `${urlBunch.hostname}/course`, //Get all courses
      "checkcourse" : `${urlBunch.hostname}/course`, //Check the course
    },
    test : {
      "prevtest" : `/assets/prevtest.json`, //Get prev test
      "test" : `/assets/test`, //Get test
      "postprevtest" : `${urlBunch.hostname}/course/prevtest`, //post a prev test
      "posttest" : `${urlBunch.hostname}/course/test`, //post a prev test
      "registerattempt" : `${urlBunch.hostname}/course/registerattempt`, //post a prev test
      "attempt" : `${urlBunch.hostname}/course/attempt`, //post a prev test
    },
    lesson : {
      "lesson" : `${urlBunch.hostname}/course/lesson`, //Get lesson
    }
  };
}
