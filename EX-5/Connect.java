package CONNECT;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Connect
 */
@WebServlet("/Connect")
public class Connect extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Connect() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
		
		response.setContentType("text/html");

		PrintWriter out = response.getWriter();

		try {

		Class.forName("com.mysql.jdbc.Driver");

		String URL = "jdbc:mysql://localhost:3306/bookdatabase";

		Connection conn = DriverManager.getConnection(URL, "root", "");
		
		PreparedStatement ps1 = conn.prepareStatement("insert into books values (?, ?, ?, ?, ?, ?)");


				ps1.setString(1, request.getParameter("m1"));
				ps1.setString(2, request.getParameter("m2"));
				ps1.setString(3, request.getParameter("m3"));
				ps1.setString(4, request.getParameter("m4"));
				ps1.setString(5, request.getParameter("m5"));
				ps1.setString(6, request.getParameter("m6"));
				
				PreparedStatement ps=conn.prepareStatement("select * from books");

				ps1.executeUpdate();

				ResultSet rs=ps.executeQuery();

						out.println("<center><h1>Book Details</h1></center>");

						out.println("<hr>");
						out.println("<table border='1'>");
			            out.println("<tr><th>BOOK NAME</th><th>AUTHOR</th><th>PUBLISHER</th><th>EDITION</th><th>PRICE</th><th>CATEGORY</th></tr>");

						while (rs.next()) {
							out.println("<tr>");

						out.println("<td>"+rs.getString(1));

						
						out.println("<td>"+rs.getString(2));

						

						out.println("<td>"+rs.getString(3));

						
						out.println("<td>"+rs.getString(1));

						
						out.println("<td>"+rs.getString(2));

						

						out.println("<td>"+rs.getString(3));
						out.println("</tr>");

						}
						 out.println("</table>");

						conn.close();
						
				

				} catch (Exception e) {
					out.println(e);
				}
	}

}
