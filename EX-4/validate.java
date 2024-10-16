package validate;
import java.io.*;
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.*;
import javax.servlet.http.*;

/**
 * Servlet implementation class validate
 */

public class validate extends HttpServlet {
	
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		response.setContentType("text/html");
		PrintWriter a = response.getWriter();
		String NAME = request.getParameter("m1");
	    String ROLL_NO = request.getParameter("m2");
		String GENDER = request.getParameter("m3");
		String DEPARTMENT = request.getParameter("m4");
		String SECTION = request.getParameter("m5");
		String MOBILE_NO = request.getParameter("m6");
		String EMAILID = request.getParameter("m7");
		String ADDRESS = request.getParameter("m8");
		String CITY = request.getParameter("m9");
		String COUNTRY = request.getParameter("m10");
		String PINCODE = request.getParameter("m11");
		a.println("<h3> Name is :<h3>"+NAME);
		a.println("<h3> roll no is :<h3>"+ROLL_NO);
		a.println("<h3> gender is :<h3>"+GENDER);
		a.println("<h3> Department is :<h3>"+DEPARTMENT);
		a.println("<h3> Section is :<h3>"+SECTION);
		a.println("<h3> Mobile no is :<h3>"+MOBILE_NO);
		a.println("<h3> Email id is :<h3>"+EMAILID);
		a.println("<h3> Address is :<h3>"+ADDRESS);
		a.println("<h3> City is :<h3>"+CITY);
		a.println("<h3> Country is :<h3>"+COUNTRY);
		a.println("<h3> Pincode is :<h3>"+PINCODE);
		
	}

}
